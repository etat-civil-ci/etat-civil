<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActeDeces;
use App\Models\TypeLocalite;
use App\Models\Localite;
use Illuminate\Support\Facades\Storage;

class ActeDecesController extends Controller
{
    public function index(Request $request)
    {
        $query = ActeDeces::query();

        // Recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('numero_acte', 'like', "%$search%")
                ->orWhere('nom_defunt', 'like', "%$search%")
                ->orWhere('prenom_defunt', 'like', "%$search%")
                ->orWhere('nom_declarant', 'like', "%$search%")
                ->orWhere('prenom_declarant', 'like', "%$search%");
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

        $actesDeces = $query->paginate(10);

        return view('frontend.listeactedeces', compact('actesDeces'));
    }

    public function createactedeces()
    {
        $typesLocalites = TypeLocalite::all();
        return view('frontend.actedeces.createactedeces', compact('typesLocalites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'filiation' => 'required|string|max:100',
            'nom_declarant' => 'required|string|max:100',
            'prenom_declarant' => 'required|string|max:100',
            'date_deces' => 'required|date',
            'date_acte' => 'required|date|after_or_equal:date_deces',
            'nom_defunt' => 'required|string|max:100',
            'prenom_defunt' => 'required|string|max:100',
            'lieu_deces' => 'required|string|max:100',
            'type_localite' => 'required|exists:type_localite,id',
            'localite_id' => 'required|exists:localite,id',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:100',
            'type_parent' => 'nullable|string|max:100',
            'nom_parent' => 'nullable|string|max:100',
            'prenom_parent' => 'nullable|string|max:100',
            'cause_deces' => 'nullable|string|max:255',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Génération du numéro d'acte
        $numeroActe = 'AD-' . date('Y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Création de l'acte sans les documents d'abord
        $acte = ActeDeces::create([
            'filiation' => $validated['filiation'],
            'nom_declarant' => $validated['nom_declarant'],
            'prenom_declarant' => $validated['prenom_declarant'],
            'date_deces' => $validated['date_deces'],
            'date_acte' => $validated['date_acte'],
            'nom_defunt' => $validated['nom_defunt'],
            'prenom_defunt' => $validated['prenom_defunt'],
            'lieu_deces' => $validated['lieu_deces'],
            'localite_id' => $validated['localite_id'],
            'date_naissance' => $validated['date_naissance'],
            'lieu_naissance' => $validated['lieu_naissance'],
            'type_parent' => $validated['type_parent'],
            'nom_parent' => $validated['nom_parent'],
            'prenom_parent' => $validated['prenom_parent'],
            'cause_deces' => $validated['cause_deces'],
            'numero_acte' => $numeroActe,
            'statut' => 'en cours',
            'documents' => null,
            'user_id' => auth()->id(),
        ]);

        // Gestion des documents
        if ($request->hasFile('documents')) {
            $paths = [];
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents/actes_deces', 'public');
                $paths[] = $path;
            }
            $acte->update(['documents' => json_encode($paths)]);
        }

        return redirect()->route('listeactedeces')
                         ->with('success', 'Acte de décès enregistré avec succès!');
    }

    public function getLocalites($typeId)
    {
        $localites = Localite::where('type_localite_id', $typeId)->get();
        return response()->json($localites);
    }

    public function show(ActeDeces $acteDeces)
    {
        return view('frontend.actedeces.show', compact('acteDeces'));
    }

    public function edit(ActeDeces $acteDeces)
    {
        $typesLocalites = TypeLocalite::all();
        $localites = Localite::where('type_localite_id', $acteDeces->localite->type_localite_id)->get();
        
        return view('frontend.actedeces.edit', compact('acteDeces', 'typesLocalites', 'localites'));
    }

    public function update(Request $request, ActeDeces $acteDeces)
    {
        $validated = $request->validate([
            'filiation' => 'required|string|max:100',
            'nom_declarant' => 'required|string|max:100',
            'prenom_declarant' => 'required|string|max:100',
            'date_deces' => 'required|date',
            'date_acte' => 'required|date|after_or_equal:date_deces',
            'nom_defunt' => 'required|string|max:100',
            'prenom_defunt' => 'required|string|max:100',
            'lieu_deces' => 'required|string|max:100',
            'localite_id' => 'required|exists:localite,id',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:100',
            'type_parent' => 'nullable|string|max:100',
            'nom_parent' => 'nullable|string|max:100',
            'prenom_parent' => 'nullable|string|max:100',
            'cause_deces' => 'nullable|string|max:255',
            'statut' => 'required|in:en cours,succès,échec',
            'new_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'delete_documents.*' => 'nullable|numeric',
        ]);

        // Gestion des documents existants
        $currentDocuments = $acteDeces->documents ? json_decode($acteDeces->documents) : [];

        // Suppression des documents cochés
        if ($request->has('delete_documents')) {
            foreach ($request->input('delete_documents') as $index) {
                if (isset($currentDocuments[$index])) {
                    Storage::disk('public')->delete($currentDocuments[$index]);
                    unset($currentDocuments[$index]);
                }
            }
            $currentDocuments = array_values($currentDocuments);
        }

        // Ajout des nouveaux documents
        if ($request->hasFile('new_documents')) {
            foreach ($request->file('new_documents') as $file) {
                $path = $file->store('documents/actes_deces', 'public');
                $currentDocuments[] = $path;
            }
        }

        $validated['documents'] = !empty($currentDocuments) ? json_encode($currentDocuments) : null;

        // Mise à jour de l'acte
        $acteDeces->update($validated);

        return redirect()->route('actedeces.show', $acteDeces->id)
                        ->with('success', 'Acte de décès mis à jour avec succès!');
    }

    public function deleteDocument(ActeDeces $acteDeces, $documentIndex)
    {
        $documents = json_decode($acteDeces->documents);
        
        if (isset($documents[$documentIndex])) {
            Storage::disk('public')->delete($documents[$documentIndex]);
            
            unset($documents[$documentIndex]);
            $documents = array_values($documents);
            
            $acteDeces->update([
                'documents' => !empty($documents) ? json_encode($documents) : null
            ]);
            
            return back()->with('success', 'Document supprimé');
        }
        
        return back()->with('error', 'Document introuvable');
    }

    public function destroy($id)
    {
        $acte = ActeDeces::findOrFail($id);

        // Supprimer les fichiers joints
        if ($acte->documents) {
            foreach (json_decode($acte->documents, true) as $document) {
                Storage::disk('public')->delete($document);
            }
        }

        $acte->delete();

        return redirect()->route('listeactedeces')->with('success', 'Acte de décès supprimé avec succès.');
    }
}