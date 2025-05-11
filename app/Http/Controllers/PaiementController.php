<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Demande;
use App\Models\ActeNaissance;
use App\Models\ActeDeces;
use App\Models\ActeMariage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\DownloadHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PaiementController extends Controller
{
    /**
     * Afficher le formulaire de paiement
     */
    public function create(Request $request)
    {
        $demande_id = $request->demande_id;
        $demande = Demande::findOrFail($demande_id);
        
        // Vérifier que l'utilisateur est bien le propriétaire de la demande
        if ($demande->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        // Utilisez les mêmes valeurs que dans showActeDetails
        $prix_copie = 500;
        $frais = 200;
        $montant = ($prix_copie + $frais) * $demande->nombre_copie;
        
        return view('frontend.demande.paiement', [
            'demande' => $demande,
            'montant' => $montant
        ]);
    }
    
    /**
     * Traiter la demande de paiement
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'demande_id' => 'required|exists:demandes,id',
            'pays' => 'required|string|max:100',
            'operateur' => 'required|in:MTN,MOOV,ORANGE',
            'numero_telephone' => 'required|string|max:20',
            'montant' => 'required|numeric|min:1',
        ]);

        // Récupération de la demande
        $demande = Demande::findOrFail($validated['demande_id']);
        
        // Vérification des autorisations
        if ($demande->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        // Vérification de l'acte associé
        $acte = null;
        $type_acte = $demande->type_acte;
        $template_pdf = '';
        
        if ($type_acte === 'naissance') {
            $acte = ActeNaissance::find($demande->acte_id);
            $template_pdf = 'pdf.acte_naissance';
            $prefix_fichier = 'acte-naissance';
            $route_redirect = 'demandes.acte-naissance.create';
        } elseif ($type_acte === 'deces') {
            $acte = ActeDeces::find($demande->acte_id);
            $template_pdf = 'pdf.acte_deces';
            $prefix_fichier = 'acte-deces';
            $route_redirect = 'demandes.acte-deces.create';
        }elseif ($type_acte === 'mariage') {
            $acte = ActeMariage::find($demande->acte_id);
            $template_pdf = 'pdf.acte_mariage';
            $prefix_fichier = 'acte-mariage';
            $route_redirect = 'demandes.acte-mariage.create';
        } else {
            return redirect()->back()
                ->with('error', 'Type d\'acte non pris en charge');
        }
        
        if (!$demande->acte_id || !$acte) {
            return redirect()->back()
                ->with('error', 'Erreur: Acte non associé à cette demande');
        }

        // Génération de la référence de transaction
        $reference = 'TRX-' . strtoupper(Str::random(10));

        // Enregistrement du paiement
        Payment::create([
            'user_id' => Auth::id(),
            'demande_id' => $demande->id,
            'pays' => $validated['pays'],
            'operateur' => $validated['operateur'],
            'numero_telephone' => $validated['numero_telephone'],
            'montant' => $validated['montant'],
            'reference_transaction' => $reference,
            'statut' => 'succès',
            'date_paiement' => now()
        ]);

        // Mise à jour du statut de la demande
        $demande->update(['statut' => 'traitee']);

        // Création de l'historique de téléchargement
        DownloadHistory::create([
            'demande_id' => $demande->id,
            'user_id' => Auth::id(),
            'copies_downloaded' => $demande->nombre_copie,
            'last_download_at' => now()
        ]);

        // Données pour le PDF
        $data = [
            'acte' => $acte,
            'demande' => $demande,
            'copies' => $demande->nombre_copie,
            'reference' => $reference,
            'date_paiement' => now()->format('d/m/Y H:i')
        ];

        // Génération du PDF
        $pdf = Pdf::loadView($template_pdf, $data);

        // Nom du fichier PDF
        $fileName = "{$prefix_fichier}-{$demande->numero_acte}-{$reference}.pdf";
        
        // Au lieu d'utiliser storage_path, nous stockons directement dans public_path
        // qui est accessible via le navigateur sans restriction
        $publicTempDir = public_path('downloads/temp');
        
        // Créer le répertoire s'il n'existe pas
        if (!file_exists($publicTempDir)) {
            mkdir($publicTempDir, 0755, true);
        }
        
        $tempPath = $publicTempDir . '/' . $fileName;
        $pdf->save($tempPath);
        
        // URL pour le téléchargement direct (chemin relatif depuis la racine du site)
        $downloadUrl = '/downloads/temp/' . $fileName;

        // Préparation pour le téléchargement de plusieurs copies
        if ($demande->nombre_copie > 1) {
            // Créer une archive ZIP pour plusieurs copies
            $zipFileName = "{$prefix_fichier}-{$demande->numero_acte}-{$reference}-copies.zip";
            $zipPath = $publicTempDir . '/' . $zipFileName;
            
            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                for ($i = 1; $i <= $demande->nombre_copie; $i++) {
                    $copyFileName = "{$prefix_fichier}-{$demande->numero_acte}-{$reference}-copy-{$i}.pdf";
                    $zip->addFromString($copyFileName, $pdf->output());
                }
                $zip->close();
                
                // URL pour le téléchargement de l'archive ZIP
                $downloadUrl = '/downloads/temp/' . $zipFileName;
            }
        }
        
        // Stocker une référence à ce fichier dans la session pour pouvoir le nettoyer plus tard
        if (!session()->has('temp_files')) {
            session()->put('temp_files', []);
        }
        $tempFiles = session('temp_files');
        $tempFiles[] = $demande->nombre_copie > 1 ? $zipPath : $tempPath;
        session()->put('temp_files', $tempFiles);

        // Redirection vers la page du formulaire de demande avec le téléchargement déclenché
        return redirect()
            ->route($route_redirect)
            ->with('success', 'Paiement effectué avec succès. Votre document est en cours de téléchargement.')
            ->with('pdf_generated', true)
            ->with('pdf_url', $downloadUrl);
    }
}