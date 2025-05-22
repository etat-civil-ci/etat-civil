<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Payment;
use App\Models\DownloadHistory;
use App\Models\User;
use App\Models\ActeNaissance;
use App\Models\ActeMariage;
use App\Models\ActeDeces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use Carbon\Carbon;

class ValidatorDemandeController extends Controller
{
    public function index(Request $request)
    {
        $statut = $request->input('statut');
        $type = $request->input('type_acte');
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

        $demandes = Demande::with(['user', 'localite', 'payment']); 
        
        if ($statut) {
            $demandes->where('statut', $statut);
        }
        
        if ($type) {
            $demandes->where('type_acte', $type);
        }
        
        if ($dateDebut) {
            $demandes->whereDate('created_at', '>=', $dateDebut);
        }
        
        if ($dateFin) {
            $demandes->whereDate('created_at', '<=', $dateFin);
        }
        
        $demandes = $demandes->orderBy('created_at', 'desc')->paginate(15);
        
        $totalDemandes = Demande::count();
        $demandesEnAttente = Demande::where('statut', 'en_attente')->count();
        $demandesValidees = Demande::where('statut', 'traitee')->count();
        $demandesRejetees = Demande::where('statut', 'rejetee')->count();
        
        return view('admin.demandes.index', compact(
            'demandes', 
            'totalDemandes', 
            'demandesEnAttente', 
            'demandesValidees', 
            'demandesRejetees'
        ));
    }

    
    public function create()
    {
        $users = User::where('role', 'citoyen')->get();
        $localites = \App\Models\Localite::all();
        $types = ['naissance', 'mariage', 'deces']; 
        
        return view('admin.demandes.create', compact('users', 'localites', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type_acte' => 'required|in:naissance,mariage,deces', 
            'localite_id' => 'nullable|exists:localite,id', 
            'numero_acte' => 'required|string|max:255', 
            'date_acte' => 'required|date', 
            'nombre_copie' => 'required|integer|min:1', 
        ]);
        
        $demande = new Demande();
        $demande->user_id = $request->user_id;
        $demande->type_acte = $request->type_acte; 
        $demande->localite_id = $request->localite_id;
        $demande->numero_acte = $request->numero_acte; 
        $demande->date_acte = $request->date_acte; 
        $demande->nombre_copie = $request->nombre_copie;
        $demande->statut = 'en_attente'; 
        $demande->save();
        
        // Si le paiement est inclus dans la demande
        if ($request->input('inclure_paiement')) {
            $montant = 700; // Montant fixe pour un acte
            
            $paiement = new Payment(); 
            $paiement->demande_id = $demande->id;
            $paiement->user_id = $request->user_id;
            $paiement->montant = $montant;
            $paiement->operateur = 'Administrateur'; 
            $paiement->pays = 'Côte d\'Ivoire'; 
            $paiement->numero_telephone = 'N/A';
            $paiement->reference_transaction = 'PAY-' . Str::upper(Str::random(8)); 
            $paiement->statut = 'traitee'; 
            $paiement->save();
        }
        
        // Enregistrer l'acte correspondant selon le type de document
        // Ces méthodes créent des actes par défaut si non fournis par le formulaire
        if ($request->type_acte == 'naissance') { 
            $this->createActeNaissance($demande, $request);
        } elseif ($request->type_acte == 'mariage') { 
            $this->createActeMarriage($demande, $request);
        } elseif ($request->type_acte == 'deces') { 
            $this->createActeDeces($demande, $request);
        }
        
        return redirect()->route('demandes.index')
            ->with('success', 'Demande créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Charger les relations nécessaires pour la vue show
        $demande = Demande::with(['user', 'localite', 'payment', 'downloadHistory'])->findOrFail($id); 
        
        // $demande = Demande::with(['user', 'localite', 'payment', 'downloadHistory', 'notes.admin'])->findOrFail($id);

        return view('admin.demandes.show', compact('demande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demande = Demande::findOrFail($id);
        $users = User::where('role', 'citoyen')->get();
        $localites = \App\Models\Localite::all();
        $types = ['naissance', 'mariage', 'deces']; 
        
        return view('admin.demandes.edit', compact('demande', 'users', 'localites', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type_acte' => 'required|in:naissance,mariage,deces', 
            'localite_id' => 'nullable|exists:localite,id', 
            'statut' => 'required|in:en_attente,traitee,rejetee',
            'numero_acte' => 'required|string|max:255', 
            'date_acte' => 'required|date', 
            'nombre_copie' => 'required|integer|min:1', 
        ]);
        
        $demande = Demande::findOrFail($id);
        $demande->user_id = $request->user_id;
        $demande->type_acte = $request->type_acte; 
        $demande->localite_id = $request->localite_id;
        $demande->numero_acte = $request->numero_acte; 
        $demande->date_acte = $request->date_acte;
        $demande->nombre_copie = $request->nombre_copie;
        $demande->statut = $request->statut;
        $demande->save();
        
        return redirect()->route('demandes.index')
            ->with('success', 'Demande mise à jour avec succès');
    }
    
    /**
     * Valider une demande
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valider($id)
    {
        $demande = Demande::findOrFail($id);
        
        // Vérifier si la demande a un paiement associé
        // Assurez-vous que la relation 'payment' est définie dans le modèle Demande
        if (!$demande->payment) { 
            return redirect()->back()
                ->with('error', 'Cette demande ne peut pas être validée car aucun paiement n\'a été effectué.');
        }
        
        $demande->statut = 'traitee';
        $demande->save();
        
        // Générer le document PDF
        $this->genererDocumentPDF($demande);
        
        return redirect()->route('demandes.show', $demande->id)
            ->with('success', 'Demande validée avec succès. Le document est maintenant disponible au téléchargement.');
    }
    
    /**
     * Rejeter une demande
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejeter($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'rejetee';
        $demande->motif_rejet = $request->input('motif_rejet');
        $demande->save();
        
        return redirect()->route('demandes.show', $demande->id)
            ->with('success', 'Demande rejetée avec succès.');
    }
    
    /**
     * Télécharger le document
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function telecharger($id)
    {
        $demande = Demande::findOrFail($id);
        
        if ($demande->statut != 'traitee') {
            return redirect()->back()
                ->with('error', 'Ce document n\'est pas disponible au téléchargement car la demande n\'a pas été validée.');
        }
        
        // Enregistrer l'historique de téléchargement
        $download = new DownloadHistory();
        $download->demande_id = $demande->id;
        $download->user_id = Auth::id();
        $download->save();
        
        $filePath = 'documents/' . $demande->id . '.pdf'; 
        
        if (!Storage::exists($filePath)) {
            // Si le document n'existe pas, le générer
            $this->genererDocumentPDF($demande);
        }
        
        return Storage::download($filePath, $demande->type_acte . ' - ' . $demande->id . '.pdf'); 
    }
    
    /**
     * Envoyer le document par email
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function envoyer($id)
    // {
    //     $demande = Demande::findOrFail($id);
        
    //     if ($demande->statut != 'traitee') {
    //         return redirect()->back()
    //             ->with('error', 'Ce document ne peut pas être envoyé car la demande n\'a pas été validée.');
    //     }
        
    //     // TODO: Implémenter l'envoi d'email avec le document en pièce jointe
    //     // Exemple: Mail::to($demande->user->email)->send(new DocumentMail($demande));
        
    //     return redirect()->back()
    //         ->with('success', 'Document envoyé par email avec succès.');
    // }
    
    /**
     * Ajouter une note à la demande
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function addNote(Request $request, $id)
    // {
    //     $request->validate([
    //         'note' => 'required|string',
    //     ]);
        
    //     $demande = Demande::findOrFail($id);
        
    //     // Assurez-vous que le modèle Note existe et qu'il a les colonnes 'demande_id', 'admin_id', 'contenu'
    //     // Et que le modèle User a une relation 'notes' et que 'admin_id' est l'ID de l'utilisateur authentifié
    //     $note = new \App\Models\Note(); // Assurez-vous d'avoir un modèle Note
    //     $note->demande_id = $demande->id;
    //     $note->admin_id = Auth::id(); // L'ID de l'utilisateur authentifié (admin)
    //     $note->contenu = $request->note;
    //     $note->save();
        
    //     return redirect()->back()
    //         ->with('success', 'Note ajoutée avec succès.');
    // }
    
    /**
     * Générer un document PDF pour une demande
     *
     * @param  \App\Models\Demande  $demande
     * @return void
     */
    // private function genererDocumentPDF(Demande $demande)
    // {
    //     // Déterminer le type de document et charger les données correspondantes
    //     if ($demande->type_acte == 'naissance') {
    //         $acte = ActeNaissance::where('demande_id', $demande->id)->first();
    //         $view = 'documents.acte_naissance';
    //     } elseif ($demande->type_acte == 'mariage') { 
    //         $acte = ActeMariage::where('demande_id', $demande->id)->first(); 
    //         $view = 'documents.acte_mariage';
    //     } elseif ($demande->type_acte == 'deces') { 
    //         $acte = ActeDeces::where('demande_id', $demande->id)->first();
    //         $view = 'documents.acte_deces';
    //     } else {
    //         // Gérer le cas où le type_acte n'est pas reconnu
    //         throw new \Exception('Type d\'acte non reconnu pour la génération de PDF.');
    //     }
        
    //     // Si l'acte n'existe pas, créer un modèle par défaut
    //     if (!$acte) {
    //         if ($demande->type_acte == 'naissance') { 
    //             $acte = $this->createActeNaissance($demande);
    //         } elseif ($demande->type_acte == 'mariage') {
    //             $acte = $this->createActeMarriage($demande); 
    //         } elseif ($demande->type_acte == 'deces') { 
    //             $acte = $this->createActeDeces($demande);
    //         }
    //     }
        
    //     // Générer le PDF
    //     // Assurez-vous que la route 'verifier.document' existe et est configurée
    //     $qrCodeUrl = route('verifier.document', ['reference' => $demande->id]); // Utilisez l'ID de la demande si 'reference' n'existe pas
        
    //     $pdf = PDF::loadView($view, [
    //         'demande' => $demande,
    //         'acte' => $acte,
    //         'user' => $demande->user,
    //         'localite' => $demande->localite,
    //         'qrCode' => $qrCodeUrl
    //     ]);
        
    //     // Sauvegarder le PDF
    //     $filePath = 'documents/' . $demande->id . '.pdf'; // Utilisation de l'ID de la demande pour le nom de fichier
    //     Storage::put($filePath, $pdf->output());
    // }
    
    /**
     * Créer un acte de naissance par défaut
     *
     * @param  \App\Models\Demande  $demande
     * @param  \Illuminate\Http\Request|null  $request
     * @return \App\Models\ActeNaissance
     */
    private function createActeNaissance(Demande $demande, Request $request = null)
    {
        $acte = new ActeNaissance();
        $acte->demande_id = $demande->id;
        // Utilisation de $demande->user->name pour le nom, car la table users n'a pas 'nom'/'prenom' séparés
        $acte->nom = $request ? $request->input('nom') : ($demande->user->name ?? 'Nom par défaut');
        $acte->date_naissance = $request ? $request->input('date_naissance') : Carbon::now()->subYears(25)->format('Y-m-d');
        $acte->lieu_naissance = $request ? $request->input('lieu_naissance') : ($demande->localite->nom ?? 'Lieu de naissance par défaut');
        $acte->sexe = $request ? $request->input('sexe') : 'M';
        $acte->nom_pere = $request ? $request->input('nom_pere') : 'Père par défaut';
        $acte->nom_mere = $request ? $request->input('nom_mere') : 'Mère par défaut';
        $acte->numero_acte = 'N' . rand(10000, 99999) . '/CIVIL/' . date('Y');
        $acte->save();
        
        return $acte;
    }
    
    /**
     * Créer un acte de mariage par défaut
     *
     * @param  \App\Models\Demande  $demande
     * @param  \Illuminate\Http\Request|null  $request
     * @return \App\Models\ActeMarriage
     */
    private function createActeMarriage(Demande $demande, Request $request = null)
    {
        $acte = new ActeMariage(); 
        $acte->demande_id = $demande->id;
        $acte->nom_epoux = $request ? $request->input('nom_epoux') : 'Époux par défaut';
        $acte->prenom_epoux = $request ? $request->input('prenom_epoux') : 'Prénom Époux par défaut';
        $acte->nom_epouse = $request ? $request->input('nom_epouse') : 'Épouse par défaut';
        $acte->prenom_epouse = $request ? $request->input('prenom_epouse') : 'Prénom Épouse par défaut';
        $acte->date_mariage = $request ? $request->input('date_mariage') : Carbon::now()->subMonths(3)->format('Y-m-d');
        $acte->lieu_mariage = $request ? $request->input('lieu_mariage') : ($demande->localite->nom ?? 'Lieu de mariage par défaut');
        $acte->regime_matrimonial = $request ? $request->input('regime_matrimonial') : 'Communauté de biens';
        $acte->numero_acte = 'M' . rand(10000, 99999) . '/CIVIL/' . date('Y');
        $acte->save();
        
        return $acte;
    }
    
    /**
     * Créer un acte de décès par défaut
     *
     * @param  \App\Models\Demande  $demande
     * @param  \Illuminate\Http\Request|null  $request
     * @return \App\Models\ActeDeces
     */
    private function createActeDeces(Demande $demande, Request $request = null)
    {
        $acte = new ActeDeces();
        $acte->demande_id = $demande->id;
        $acte->nom_defunt = $request ? $request->input('nom_defunt') : 'Défunt par défaut';
        $acte->prenom_defunt = $request ? $request->input('prenom_defunt') : 'Prénom Défunt par défaut';
        $acte->date_naissance = $request ? $request->input('date_naissance') : Carbon::now()->subYears(70)->format('Y-m-d');
        $acte->lieu_naissance = $request ? $request->input('lieu_naissance') : 'Lieu de naissance par défaut';
        $acte->date_deces = $request ? $request->input('date_deces') : Carbon::now()->subDays(15)->format('Y-m-d');
        $acte->lieu_deces = $request ? $request->input('lieu_deces') : ($demande->localite->nom ?? 'Lieu de décès par défaut');
        $acte->cause_deces = $request ? $request->input('cause_deces') : 'Cause naturelle';
        $acte->numero_acte = 'D' . rand(10000, 99999) . '/CIVIL/' . date('Y');
        $acte->save();
        
        return $acte;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Pas de suppression physique des demandes pour garder un historique
        $demande = Demande::findOrFail($id);
        $demande->statut = 'rejetee'; 
        $demande->save();
        
        return redirect()->route('demandes.index')
            ->with('success', 'Demande annulée avec succès');
    }
}


















// class DemandeController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index(Request $request)
//     {
//         $statut = $request->input('statut');
//         $type = $request->input('type');
//         $dateDebut = $request->input('date_debut');
//         $dateFin = $request->input('date_fin');
        
//         $demandes = Demande::with(['user', 'localite', 'payement']);
        
//         if ($statut) {
//             $demandes->where('statut', $statut);
//         }
        
//         if ($type) {
//             $demandes->where('type_document', $type);
//         }
        
//         if ($dateDebut) {
//             $demandes->whereDate('created_at', '>=', $dateDebut);
//         }
        
//         if ($dateFin) {
//             $demandes->whereDate('created_at', '<=', $dateFin);
//         }
        
//         $demandes = $demandes->orderBy('created_at', 'desc')->paginate(15);
        
//         $totalDemandes = Demande::count();
//         $demandesEnAttente = Demande::where('statut', 'en_attente')->count();
//         $demandesValidees = Demande::where('statut', 'traitee')->count();
//         $demandesRejetees = Demande::where('statut', 'rejetee')->count();
        
//         return view('admin.demandes.index', compact(
//             'demandes', 
//             'totalDemandes', 
//             'demandesEnAttente', 
//             'demandesValidees', 
//             'demandesRejetees'
//         ));
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         $users = User::where('role', 'citoyen')->get();
//         $localites = \App\Models\Localite::all();
//         $types = ['Acte de naissance', 'Acte de mariage', 'Acte de décès'];
        
//         return view('admin.demandes.create', compact('users', 'localites', 'types'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'user_id' => 'required|exists:users,id',
//             'type_document' => 'required',
//             'localite_id' => 'required|exists:localite,id',
//             'motif' => 'required|string|max:255',
//         ]);
        
//         $demande = new Demande();
//         $demande->user_id = $request->user_id;
//         $demande->type_document = $request->type_document;
//         $demande->localite_id = $request->localite_id;
//         $demande->motif = $request->motif;
//         $demande->statut = 'en attente';
//         $demande->reference = 'DEM-' . Str::upper(Str::random(8));
//         $demande->save();
        
//         // Si le paiement est inclus dans la demande
//         if ($request->input('inclure_paiement')) {
//             $montant = 2500; // Montant fixe pour un acte
            
//             $paiement = new Payement();
//             $paiement->demande_id = $demande->id;
//             $paiement->user_id = $request->user_id;
//             $paiement->montant = $montant;
//             $paiement->methode = 'Administrateur';
//             $paiement->reference = 'PAY-' . Str::upper(Str::random(8));
//             $paiement->statut = 'complété';
//             $paiement->save();
//         }
        
//         // Enregistrer l'acte correspondant selon le type de document
//         if ($request->type_document == 'Acte de naissance') {
//             $this->createActeNaissance($demande, $request);
//         } elseif ($request->type_document == 'Acte de mariage') {
//             $this->createActeMarriage($demande, $request);
//         } elseif ($request->type_document == 'Acte de décès') {
//             $this->createActeDeces($demande, $request);
//         }
        
//         return redirect()->route('demandes.index')
//             ->with('success', 'Demande créée avec succès');
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         $demande = Demande::with(['user', 'localite', 'payement', 'downloadHistory'])->findOrFail($id);
        
//         return view('admin.demandes.show', compact('demande'));
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         $demande = Demande::findOrFail($id);
//         $users = User::where('role', 'citoyen')->get();
//         $localites = \App\Models\Localite::all();
//         $types = ['Acte de naissance', 'Acte de mariage', 'Acte de décès'];
        
//         return view('admin.demandes.edit', compact('demande', 'users', 'localites', 'types'));
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'user_id' => 'required|exists:users,id',
//             'type_document' => 'required',
//             'localite_id' => 'required|exists:localite,id',
//             'motif' => 'required|string|max:255',
//             'statut' => 'required|in:en_attente,traitee,rejetee',
//         ]);
        
//         $demande = Demande::findOrFail($id);
//         $demande->user_id = $request->user_id;
//         $demande->type_document = $request->type_document;
//         $demande->localite_id = $request->localite_id;
//         $demande->motif = $request->motif;
//         $demande->statut = $request->statut;
//         $demande->save();
        
//         return redirect()->route('demandes.index')
//             ->with('success', 'Demande mise à jour avec succès');
//     }
    
//     /**
//      * Valider une demande
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function valider($id)
//     {
//         $demande = Demande::findOrFail($id);
        
//         // Vérifier si la demande a un paiement associé
//         if (!$demande->payement) {
//             return redirect()->back()
//                 ->with('error', 'Cette demande ne peut pas être validée car aucun paiement n\'a été effectué.');
//         }
        
//         $demande->statut = 'traitee';
//         $demande->save();
        
//         // Générer le document PDF
//         $this->genererDocumentPDF($demande);
        
//         return redirect()->route('demandes.show', $demande->id)
//             ->with('success', 'Demande validée avec succès. Le document est maintenant disponible au téléchargement.');
//     }
    
//     /**
//      * Rejeter une demande
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function rejeter($id)
//     {
//         $demande = Demande::findOrFail($id);
//         $demande->statut = 'rejetee';
//         $demande->save();
        
//         return redirect()->route('demandes.show', $demande->id)
//             ->with('success', 'Demande rejetée avec succès.');
//     }
    
//     /**
//      * Télécharger le document
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function telecharger($id)
//     {
//         $demande = Demande::findOrFail($id);
        
//         if ($demande->statut != 'traitee') {
//             return redirect()->back()
//                 ->with('error', 'Ce document n\'est pas disponible au téléchargement car la demande n\'a pas été validée.');
//         }
        
//         // Enregistrer l'historique de téléchargement
//         $download = new DownloadHistory();
//         $download->demande_id = $demande->id;
//         $download->user_id = Auth::id();
//         $download->ip_address = request()->ip();
//         $download->save();
        
//         // Chemin du fichier
//         $filePath = 'documents/' . $demande->reference . '.pdf';
        
//         if (!Storage::exists($filePath)) {
//             // Si le document n'existe pas, le générer
//             $this->genererDocumentPDF($demande);
//         }
        
//         return Storage::download($filePath, $demande->type_document . ' - ' . $demande->reference . '.pdf');
//     }
    
//     /**
//      * Envoyer le document par email
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function envoyer($id)
//     {
//         $demande = Demande::findOrFail($id);
        
//         if ($demande->statut != 'traitee') {
//             return redirect()->back()
//                 ->with('error', 'Ce document ne peut pas être envoyé car la demande n\'a pas été validée.');
//         }
        
//         // TODO: Envoyer l'email avec le document en pièce jointe
        
//         return redirect()->back()
//             ->with('success', 'Document envoyé par email avec succès.');
//     }
    
//     /**
//      * Ajouter une note à la demande
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function addNote(Request $request, $id)
//     {
//         $request->validate([
//             'note' => 'required|string',
//         ]);
        
//         $demande = Demande::findOrFail($id);
        
//         $note = new \App\Models\Note();
//         $note->demande_id = $demande->id;
//         $note->admin_id = Auth::id();
//         $note->contenu = $request->note;
//         $note->save();
        
//         return redirect()->back()
//             ->with('success', 'Note ajoutée avec succès.');
//     }
    
//     /**
//      * Générer un document PDF pour une demande
//      *
//      * @param  \App\Models\Demande  $demande
//      * @return void
//      */
//     private function genererDocumentPDF(Demande $demande)
//     {
//         // Déterminer le type de document et charger les données correspondantes
//         if ($demande->type_document == 'Acte de naissance') {
//             $acte = ActeNaissance::where('demande_id', $demande->id)->first();
//             $view = 'documents.acte_naissance';
//         } elseif ($demande->type_document == 'Acte de mariage') {
//             $acte = ActeMarriage::where('demande_id', $demande->id)->first();
//             $view = 'documents.acte_mariage';
//         } elseif ($demande->type_document == 'Acte de décès') {
//             $acte = ActeDeces::where('demande_id', $demande->id)->first();
//             $view = 'documents.acte_deces';
//         }
        
//         // Si l'acte n'existe pas, créer un modèle par défaut
//         if (!$acte) {
//             if ($demande->type_document == 'Acte de naissance') {
//                 $acte = $this->createActeNaissance($demande);
//             } elseif ($demande->type_document == 'Acte de mariage') {
//                 $acte = $this->createActeMarriage($demande);
//             } elseif ($demande->type_document == 'Acte de décès') {
//                 $acte = $this->createActeDeces($demande);
//             }
//         }
        
//         // Générer le PDF
//         $pdf = PDF::loadView($view, [
//             'demande' => $demande,
//             'acte' => $acte,
//             'user' => $demande->user,
//             'localite' => $demande->localite,
//             'qrCode' => route('verifier.document', ['reference' => $demande->reference])
//         ]);
        
//         // Sauvegarder le PDF
//         $filePath = 'documents/' . $demande->reference . '.pdf';
//         Storage::put($filePath, $pdf->output());
//     }
    
//     /**
//      * Créer un acte de naissance par défaut
//      *
//      * @param  \App\Models\Demande  $demande
//      * @param  \Illuminate\Http\Request|null  $request
//      * @return \App\Models\ActeNaissance
//      */
//     private function createActeNaissance(Demande $demande, Request $request = null)
//     {
//         $acte = new ActeNaissance();
//         $acte->demande_id = $demande->id;
//         $acte->nom = $request ? $request->input('nom') : $demande->user->nom;
//         $acte->prenom = $request ? $request->input('prenom') : $demande->user->prenom;
//         $acte->date_naissance = $request ? $request->input('date_naissance') : Carbon::now()->subYears(25)->format('Y-m-d');
//         $acte->lieu_naissance = $request ? $request->input('lieu_naissance') : $demande->localite->nom;
//         $acte->sexe = $request ? $request->input('sexe') : 'M';
//         $acte->nom_pere = $request ? $request->input('nom_pere') : 'Père';
//         $acte->nom_mere = $request ? $request->input('nom_mere') : 'Mère';
//         $acte->numero_acte = 'N' . rand(10000, 99999) . '/CIVIL/' . date('Y');
//         $acte->save();
        
//         return $acte;
//     }
    
//     /**
//      * Créer un acte de mariage par défaut
//      *
//      * @param  \App\Models\Demande  $demande
//      * @param  \Illuminate\Http\Request|null  $request
//      * @return \App\Models\ActeMarriage
//      */
//     private function createActeMarriage(Demande $demande, Request $request = null)
//     {
//         $acte = new ActeMarriage();
//         $acte->demande_id = $demande->id;
//         $acte->nom_epoux = $request ? $request->input('nom_epoux') : 'Époux';
//         $acte->prenom_epoux = $request ? $request->input('prenom_epoux') : 'Prénom';
//         $acte->nom_epouse = $request ? $request->input('nom_epouse') : 'Épouse';
//         $acte->prenom_epouse = $request ? $request->input('prenom_epouse') : 'Prénom';
//         $acte->date_mariage = $request ? $request->input('date_mariage') : Carbon::now()->subMonths(3)->format('Y-m-d');
//         $acte->lieu_mariage = $request ? $request->input('lieu_mariage') : $demande->localite->nom;
//         $acte->regime_matrimonial = $request ? $request->input('regime_matrimonial') : 'Communauté de biens';
//         $acte->numero_acte = 'M' . rand(10000, 99999) . '/CIVIL/' . date('Y');
//         $acte->save();
        
//         return $acte;
//     }
    
//     /**
//      * Créer un acte de décès par défaut
//      *
//      * @param  \App\Models\Demande  $demande
//      * @param  \Illuminate\Http\Request|null  $request
//      * @return \App\Models\ActeDeces
//      */
//     private function createActeDeces(Demande $demande, Request $request = null)
//     {
//         $acte = new ActeDeces();
//         $acte->demande_id = $demande->id;
//         $acte->nom_defunt = $request ? $request->input('nom_defunt') : 'Défunt';
//         $acte->prenom_defunt = $request ? $request->input('prenom_defunt') : 'Prénom';
//         $acte->date_naissance = $request ? $request->input('date_naissance') : Carbon::now()->subYears(70)->format('Y-m-d');
//         $acte->lieu_naissance = $request ? $request->input('lieu_naissance') : 'Lieu de naissance';
//         $acte->date_deces = $request ? $request->input('date_deces') : Carbon::now()->subDays(15)->format('Y-m-d');
//         $acte->lieu_deces = $request ? $request->input('lieu_deces') : $demande->localite->nom;
//         $acte->cause_deces = $request ? $request->input('cause_deces') : 'Cause naturelle';
//         $acte->numero_acte = 'D' . rand(10000, 99999) . '/CIVIL/' . date('Y');
//         $acte->save();
        
//         return $acte;
//     }
    
//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         // Pas de suppression physique des demandes pour garder un historique
//         $demande = Demande::findOrFail($id);
//         $demande->statut = 'rejetee';
//         $demande->save();
        
//         return redirect()->route('demandes.index')
//             ->with('success', 'Demande annulée avec succès');
//     }
// }