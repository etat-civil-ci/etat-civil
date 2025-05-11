<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActeMariage;
use App\Models\TypeLocalite;
use App\Models\Localite;
use Illuminate\Support\Facades\Storage;

class ActeMariageController extends Controller
{
    public function index(Request $request)
    {
        $query = ActeMariage::query();

        // Recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('numero_acte', 'like', "%$search%")
                  ->orWhere('nom_epoux', 'like', "%$search%")
                  ->orWhere('prenom_epoux', 'like', "%$search%")
                  ->orWhere('nom_epouse', 'like', "%$search%")
                  ->orWhere('prenom_epouse', 'like', "%$search%");
            });
        }

        // Tri
        switch ($request->input('sort')) {
            case 'numero_acte':
                $query->orderBy('numero_acte');
                break;
            case 'date_mariage_desc':
                $query->orderByDesc('date_mariage');
                break;
            case 'date_mariage_asc':
                $query->orderBy('date_mariage');
                break;
            case 'statut':
                $query->orderBy('statut');
                break;
            default:
                $query->latest();
                break;
        }

        $actesMariage = $query->paginate(10);

        return view('frontend.listeactemariage', compact('actesMariage'));
    }

    public function createactemariage()
    {
        $typesLocalites = TypeLocalite::all();
        return view('frontend.actemariage.createactemariage', compact('typesLocalites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Informations époux
            'nom_epoux' => 'required|string|max:100',
            'prenom_epoux' => 'required|string|max:100',
            'date_naissance_epoux' => 'required|date',
            'lieu_naissance_epoux' => 'required|string|max:100',
            'numero_cni_epoux' => 'required|string|max:50',
            'domicile_epoux' => 'required|string|max:255',
            'profession_epoux' => 'required|string|max:100',
            
            // Informations épouse
            'nom_epouse' => 'required|string|max:100',
            'prenom_epouse' => 'required|string|max:100',
            'date_naissance_epouse' => 'required|date',
            'lieu_naissance_epouse' => 'required|string|max:100',
            'numero_cni_epouse' => 'required|string|max:50',
            'domicile_epouse' => 'required|string|max:255',
            'profession_epouse' => 'required|string|max:100',
            
            // Informations mariage
            'date_mariage' => 'required|date',
            'lieu_mariage' => 'required|string|max:100',
            'type_localite' => 'required|exists:type_localite,id',
            'localite_id' => 'required|exists:localite,id',
            
            // Témoins
            'nom_temoin1' => 'required|string|max:100',
            'prenom_temoin1' => 'required|string|max:100',
            'numero_cni_temoin1' => 'required|string|max:50',
            'nom_temoin2' => 'required|string|max:100',
            'prenom_temoin2' => 'required|string|max:100',
            'numero_cni_temoin2' => 'required|string|max:50',
            
            // Documents
            'extrait_naissance_epoux' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'extrait_naissance_epouse' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'photo_epoux' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'photo_epouse' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'certificat_residence_epoux' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificat_residence_epouse' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Génération du numéro d'acte
        $numeroActe = 'AM-' . date('Y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

         // Date de l'acte = date du jour au format YYYY-MM-DD
        $dateActe = now()->format('Y-m-d');

        // Stockage des documents
        $documents = [
            'extrait_naissance_epoux' => $request->file('extrait_naissance_epoux')
                ->store('documents/actes_mariage', 'public'),
            'extrait_naissance_epouse' => $request->file('extrait_naissance_epouse')
                ->store('documents/actes_mariage', 'public'),
            'photo_epoux' => $request->file('photo_epoux')
                ->store('documents/actes_mariage', 'public'),
            'photo_epouse' => $request->file('photo_epouse')
                ->store('documents/actes_mariage', 'public'),
            'certificat_residence_epoux' => $request->file('certificat_residence_epoux')
                ->store('documents/actes_mariage', 'public'),
            'certificat_residence_epouse' => $request->file('certificat_residence_epouse')
                ->store('documents/actes_mariage', 'public'),
        ];

        // Création de l'acte
        $acte = ActeMariage::create([
            // Époux
            'nom_epoux' => $validated['nom_epoux'],
            'prenom_epoux' => $validated['prenom_epoux'],
            'date_naissance_epoux' => $validated['date_naissance_epoux'],
            'lieu_naissance_epoux' => $validated['lieu_naissance_epoux'],
            'numero_cni_epoux' => $validated['numero_cni_epoux'],
            'domicile_epoux' => $validated['domicile_epoux'],
            'profession_epoux' => $validated['profession_epoux'],
            
            // Épouse
            'nom_epouse' => $validated['nom_epouse'],
            'prenom_epouse' => $validated['prenom_epouse'],
            'date_naissance_epouse' => $validated['date_naissance_epouse'],
            'lieu_naissance_epouse' => $validated['lieu_naissance_epouse'],
            'numero_cni_epouse' => $validated['numero_cni_epouse'],
            'domicile_epouse' => $validated['domicile_epouse'],
            'profession_epouse' => $validated['profession_epouse'],
            
            // Mariage
            'date_mariage' => $validated['date_mariage'],
            'lieu_mariage' => $validated['lieu_mariage'],
            'localite_id' => $validated['localite_id'],
            
            // Témoins
            'nom_temoin1' => $validated['nom_temoin1'],
            'prenom_temoin1' => $validated['prenom_temoin1'],
            'numero_cni_temoin1' => $validated['numero_cni_temoin1'],
            'nom_temoin2' => $validated['nom_temoin2'],
            'prenom_temoin2' => $validated['prenom_temoin2'],
            'numero_cni_temoin2' => $validated['numero_cni_temoin2'],
            
            // Documents
            'extrait_naissance_epoux' => $documents['extrait_naissance_epoux'],
            'extrait_naissance_epouse' => $documents['extrait_naissance_epouse'],
            'photo_epoux' => $documents['photo_epoux'],
            'photo_epouse' => $documents['photo_epouse'],
            'certificat_residence_epoux' => $documents['certificat_residence_epoux'],
            'certificat_residence_epouse' => $documents['certificat_residence_epouse'],
            
            // Autres
            'numero_acte' => $numeroActe,
            'date_acte' => $dateActe,
            'statut' => 'en cours',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('listeactemariage')
                         ->with('success', 'Acte de mariage enregistré avec succès!');
    }

    public function getLocalites($typeId)
    {
        $localites = Localite::where('type_localite_id', $typeId)->get();
        return response()->json($localites);
    }

    public function show(ActeMariage $acteMariage)
    {
        return view('frontend.actemariage.show', compact('acteMariage'));
    }

    public function edit(ActeMariage $acteMariage)
    {
        $typesLocalites = TypeLocalite::all();
        $localites = Localite::where('type_localite_id', $acteMariage->localite->type_localite_id)->get();
        
        return view('frontend.actemariage.edit', compact('acteMariage', 'typesLocalites', 'localites'));
    }

    public function update(Request $request, ActeMariage $acteMariage)
    {
        $validated = $request->validate([
            // Informations époux
            'nom_epoux' => 'required|string|max:100',
            'prenom_epoux' => 'required|string|max:100',
            'date_naissance_epoux' => 'required|date',
            'lieu_naissance_epoux' => 'required|string|max:100',
            'numero_cni_epoux' => 'required|string|max:50',
            'domicile_epoux' => 'required|string|max:255',
            'profession_epoux' => 'required|string|max:100',
            
            // Informations épouse
            'nom_epouse' => 'required|string|max:100',
            'prenom_epouse' => 'required|string|max:100',
            'date_naissance_epouse' => 'required|date',
            'lieu_naissance_epouse' => 'required|string|max:100',
            'numero_cni_epouse' => 'required|string|max:50',
            'domicile_epouse' => 'required|string|max:255',
            'profession_epouse' => 'required|string|max:100',
            
            // Informations mariage
            'date_mariage' => 'required|date',
            'lieu_mariage' => 'required|string|max:100',
            'localite_id' => 'required|exists:localite,id',
            
            // Témoins
            'nom_temoin1' => 'required|string|max:100',
            'prenom_temoin1' => 'required|string|max:100',
            'numero_cni_temoin1' => 'required|string|max:50',
            'nom_temoin2' => 'required|string|max:100',
            'prenom_temoin2' => 'required|string|max:100',
            'numero_cni_temoin2' => 'required|string|max:50',
            
            // Documents (optionnels pour la mise à jour)
            'extrait_naissance_epoux' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'extrait_naissance_epouse' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'photo_epoux' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'photo_epouse' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'certificat_residence_epoux' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificat_residence_epouse' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'statut' => 'required|in:en cours,succès,échec',
        ]);

        // Mise à jour des documents si fournis
        $documentFields = [
            'extrait_naissance_epoux',
            'extrait_naissance_epouse',
            'photo_epoux',
            'photo_epouse',
            'certificat_residence_epoux',
            'certificat_residence_epouse',
            'copie_cni_epoux',
            'copie_cni_epouse',
        ];
    
        foreach ($documentFields as $field) {
            if ($request->hasFile($field)) {
                // Supprimer l'ancien fichier
                if ($acteMariage->$field) {
                    Storage::disk('public')->delete($acteMariage->$field);
                }
                // Stocker le nouveau fichier
                $path = $request->file($field)->store('documents/actes_mariage', 'public');
                $validated[$field] = $path;
            } else {
                // Garder l'ancienne valeur si pas de nouveau fichier
                $validated[$field] = $acteMariage->$field;
            }
        }
    
        // Mise à jour de l'acte
        $acteMariage->update($validated);
    
        return redirect()->route('actemariage.show', $acteMariage->id)
                        ->with('success', 'Acte de mariage mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $acte = ActeMariage::findOrFail($id);

        // Supprimer les fichiers joints
        $documentFields = [
            'extrait_naissance_epoux',
            'extrait_naissance_epouse',
            'photo_epoux',
            'photo_epouse',
            'certificat_residence_epoux',
            'certificat_residence_epouse',
            'copie_cni_epoux',
            'copie_cni_epouse',
        ];

        foreach ($documentFields as $field) {
            if ($acte->$field) {
                Storage::disk('public')->delete($acte->$field);
            }
        }

        $acte->delete();

        return redirect()->route('listeactemariage')->with('success', 'Acte de mariage supprimé avec succès.');
    }
}