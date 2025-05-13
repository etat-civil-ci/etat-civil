<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActeNaissance;
use App\Models\TypeLocalite;
use App\Models\Localite;
use Illuminate\Support\Facades\Storage;


class ActeNaissanceController extends Controller
{
    public function index(Request $request)
    {
        $query = ActeNaissance::query();

        // Recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('numero_acte', 'like', "%$search%")
                ->orWhere('nom_enfant', 'like', "%$search%")
                ->orWhere('prenom_enfant', 'like', "%$search%")
                ->orWhere('nom_demandeur', 'like', "%$search%")
                ->orWhere('prenom_demandeur', 'like', "%$search%");
            });
        }

        // Tri
        switch ($request->input('sort')) {
            case 'numero_acte':
                $query->orderBy('numero_acte');
                break;
            case 'date_acte_desc':
                $query->orderByDesc('date_acte');
                break;
            case 'date_acte_asc':
                $query->orderBy('date_acte');
                break;
            case 'statut':
                $query->orderBy('statut');
                break;
            default:
                $query->latest();
                break;
        }

        $actesNaissance = $query->paginate(10);

        return view('frontend.listeactenaissance', compact('actesNaissance'));
    }

    public function createactenaissance()
    {
        $typesLocalites = TypeLocalite::all();
        // return view('frontend.createactenaissance', compact('typesLocalites'));
        return view('frontend.actenaissance.createactenaissance', compact('typesLocalites'));

    }

    public function store(Request $request)
{

//    dd($request->all()); 

    //Les conditions de validation de chaque champs du formulaire
    $validated = $request->validate([
        'filiation' => 'required|string|max:100',
        'nom_demandeur' => 'required|string|max:100',
        'prenom_demandeur' => 'required|string|max:100',
        'date_naissance' => 'required|date',
        'date_acte' => 'required|date|after_or_equal:date_naissance',
        'nom_enfant' => 'required|string|max:100',
        'prenom_enfant' => 'required|string|max:100',
        'lieu_naissance' => 'required|string|max:100',
        //nouvelle colonne 
        'heure_naissance' => 'nullable|date_format:H:i',
        'type_localite' => 'required|exists:type_localite,id',
        'localite_id' => 'required|exists:localite,id',
        'nom_pere' => 'nullable|string|max:100',
        'prenom_pere' => 'nullable|string|max:100',
        'domicile_pere' => 'nullable|string|max:255',
        'profession_pere' => 'nullable|string|max:100',
        'numero_cni_pere' => 'nullable|string|max:50',
        'nom_mere' => 'required|string|max:100',
        'prenom_mere' => 'required|string|max:100',
        'domicile_mere' => 'nullable|string|max:255',
        'profession_mere' => 'nullable|string|max:100',
        'numero_cni_mere' => 'nullable|string|max:50',
        'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        

    ]);


    // Génération du numéro d'acte 
    $numeroActe = 'AN-' . date('Y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

    // Création de l'acte sans les documents d'abord
    $acte = ActeNaissance::create([
        'filiation' => $validated['filiation'],
        'nom_demandeur' => $validated['nom_demandeur'],
        'prenom_demandeur' => $validated['prenom_demandeur'],
        'date_naissance' => $validated['date_naissance'],
        'date_acte' => $validated['date_acte'],
        'nom_enfant' => $validated['nom_enfant'],
        'prenom_enfant' => $validated['prenom_enfant'],
        'lieu_naissance' => $validated['lieu_naissance'],
        'heure_naissance' => $validated['heure_naissance'],
        'localite_id' => $validated['localite_id'],
        'nom_pere' => $validated['nom_pere'],
        'prenom_pere' => $validated['prenom_pere'],
        'domicile_pere' => $validated['domicile_pere'],
        'profession_pere' => $validated['profession_pere'],
        'numero_cni_pere' => $validated['numero_cni_pere'],
        'nom_mere' => $validated['nom_mere'],
        'prenom_mere' => $validated['prenom_mere'],
        'domicile_mere' => $validated['domicile_mere'],
        'profession_mere' => $validated['profession_mere'],
        'numero_cni_mere' => $validated['numero_cni_mere'],
        'numero_acte' => $numeroActe,
        'statut' => 'en cours',
        'documents' => null, // Initialisé à null

          
    ]);
    


    // Gestion des documents
    if ($request->hasFile('documents')) {
        $paths = [];
        foreach ($request->file('documents') as $file) {
            // Changez cette ligne pour stocker dans public
            $path = $file->store('documents/actes_naissance', 'public');
            $paths[] = $path;
        }
        $acte->update(['documents' => json_encode($paths)]);
    }
// dd($acte);
    $acte->save();

    return redirect()->route('listeactenaissance')
                     ->with('success', 'Acte de naissance enregistré avec succès!');
}

    public function getLocalites($typeId)
    {
        $localites = Localite::where('type_localite_id', $typeId)->get();
        return response()->json($localites);
    }

    public function show(ActeNaissance $acteNaissance)
    {
        return view('frontend.actenaissance.show', compact('acteNaissance'));
    }

    public function edit(ActeNaissance $acteNaissance)
    {
        $typesLocalites = TypeLocalite::all();
        $localites = Localite::where('type_localite_id', $acteNaissance->localite->type_localite_id)->get();
        
        return view('frontend.actenaissance.edit', compact('acteNaissance', 'typesLocalites', 'localites'));
    }

    public function update(Request $request, ActeNaissance $acteNaissance)
    {
        // Validation des données
        $validated = $request->validate([
            'filiation' => 'required|string|max:100',
            'nom_demandeur' => 'required|string|max:100',
            'prenom_demandeur' => 'required|string|max:100',
            'date_naissance' => 'required|date',
            'date_acte' => 'required|date|after_or_equal:date_naissance',
            'nom_enfant' => 'required|string|max:100',
            'prenom_enfant' => 'required|string|max:100',
            'lieu_naissance' => 'required|string|max:100',
            'localite_id' => 'required|exists:localite,id',
            'nom_pere' => 'nullable|string|max:100',
            'prenom_pere' => 'nullable|string|max:100',
            'domicile_pere' => 'nullable|string|max:255',
            'profession_pere' => 'nullable|string|max:100',
            'numero_cni_pere' => 'nullable|string|max:50',
            'nom_mere' => 'required|string|max:100',
            'prenom_mere' => 'required|string|max:100',
            'domicile_mere' => 'nullable|string|max:255',
            'profession_mere' => 'nullable|string|max:100',
            'numero_cni_mere' => 'nullable|string|max:50',
            'statut' => 'required|in:en cours,succès,échec',
            'new_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'delete_documents.*' => 'nullable|numeric',
        ]);

        // Gestion des documents existants
        $currentDocuments = $acteNaissance->documents ? json_decode($acteNaissance->documents) : [];

        // Suppression des documents cochés
        if ($request->has('delete_documents')) {
            foreach ($request->input('delete_documents') as $index) {
                if (isset($currentDocuments[$index])) {
                    Storage::disk('actes_naissance')->delete($currentDocuments[$index]);
                    unset($currentDocuments[$index]);
                }
            }
            $currentDocuments = array_values($currentDocuments);
        }

        // Ajout des nouveaux documents
        if ($request->hasFile('new_documents')) {
            foreach ($request->file('new_documents') as $file) {
                $path = $file->store('', 'actes_naissance');
                $currentDocuments[] = $path;
            }
        }

        $validated['documents'] = !empty($currentDocuments) ? json_encode($currentDocuments) : null;

        // Mise à jour de l'acte
        $acteNaissance->update($validated);

        // Redirection avec message de succès
        return redirect()->route('actenaissance.show', $acteNaissance->id)
                        ->with('success', 'Acte de naissance mis à jour avec succès!');
    }

    public function deleteDocument(ActeNaissance $acteNaissance, $documentIndex)
    {
        $documents = json_decode($acteNaissance->documents);
        
        if (isset($documents[$documentIndex])) {
            // Changez cette ligne
            Storage::disk('public')->delete($documents[$documentIndex]);
            
            unset($documents[$documentIndex]);
            $documents = array_values($documents);
            
            $acteNaissance->update([
                'documents' => !empty($documents) ? json_encode($documents) : null
            ]);
            
            return back()->with('success', 'Document supprimé');
        }
        
        return back()->with('error', 'Document introuvable');
    }

    public function destroy($id)
    {
        $acte = ActeNaissance::findOrFail($id);

        // Supprimer les fichiers joints si nécessaires
        if ($acte->documents) {
            foreach (json_decode($acte->documents, true) as $document) {
                Storage::disk('public')->delete($document);
            }
        }

        // Supprimer l’acte de naissance
        $acte->delete();

        return redirect()->route('listeactenaissance')->with('success', 'Acte de naissance supprimé avec succès.');
    }
}
