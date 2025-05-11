<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActeNaissance;
use App\Models\ActeDeces;
use App\Models\ActeMariage;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('demandes.index', compact('demandes'));
    }

    public function storeActeNaissance(Request $request)
    {
        $validated = $request->validate([
            'numero_acte' => 'required|string|max:50',
            'date_acte' => 'required|date',
            'nombre_copie' => 'required|integer|min:1|max:5',
        ]);

        $acte = ActeNaissance::where('numero_acte', $validated['numero_acte'])
                            ->where('date_acte', $validated['date_acte'])
                            ->first();

        if (!$acte) {
            return back()->withErrors([
                'numero_acte' => 'Aucun acte de naissance correspondant trouvé.',
            ])->withInput();
        }

        $demande = Demande::create([
            'user_id' => Auth::id(),
            'acte_id' => $acte->id,
            'type_acte' => 'naissance',
            'numero_acte' => $validated['numero_acte'],
            'date_acte' => $validated['date_acte'],
            'nombre_copie' => $validated['nombre_copie'],
            'statut' => 'en_attente',
            'acte_id' => $acte->id,
        ]);

        // Redirection vers la page de détails avec les paramètres
        return redirect()->route('demande.actenaissance.details', [
            'acte' => $acte->id,
            'nombre_copie' => $validated['nombre_copie'],
            'demande_id' => $demande->id
        ]);
    }

    public function showActeDetails(ActeNaissance $acte, Request $request)
    {
        if ($acte->statut !== 'succès') {
        return back()->withErrors(['statut' => 'Cet acte de naissance n’est pas encore disponible. Veuillez réessayer plus tard.']);
    }
        $nombre_copie = $request->query('nombre_copie', 1);
        $prix_copie = 500; // Prix par copie
        $frais = 200; // Frais par copie
        $total_copies = $nombre_copie * $prix_copie;
        $total_frais = $nombre_copie * $frais;
        $total_general = $total_copies + $total_frais;

        return view('frontend.demande.actenaissancedetail', [
            'acte' => $acte,
            'nombre_copie' => $nombre_copie,
            'demande_id' => $request->query('demande_id'),
            'prix_copie' => $prix_copie,
            'frais' => $frais,
            'total_copies' => $total_copies,
            'total_frais' => $total_frais,
            'total_general' => $total_general
        ]);
    }


    //ACTE DECES

    public function storeActeDeces(Request $request)
{
    $validated = $request->validate([
        'numero_acte' => 'required|string|max:50',
        'date_acte' => 'required|date',
        'date_deces' => 'required|date',
        'nombre_copie' => 'required|integer|min:1|max:5',
    ]);

    // Recherche de l'acte avec les 3 critères
    $acte = ActeDeces::where('numero_acte', $validated['numero_acte'])
                    ->where('date_acte', $validated['date_acte'])
                    ->where('date_deces', $validated['date_deces'])
                    ->first();

    if (!$acte) {
        return back()->withErrors([
            'numero_acte' => 'Aucun acte de décès correspondant trouvé avec ces informations.',
        ])->withInput();
    }

    // Vérification du statut de l'acte
    if ($acte->statut !== 'succès') {
        return back()->withErrors([
            'numero_acte' => 'Cet acte de décès n\'est pas encore validé. Statut: '.$acte->statut,
        ])->withInput();
    }

    $demande = Demande::create([
        'user_id' => Auth::id(),
        'acte_id' => $acte->id,
        'type_acte' => 'deces', // Changé de 'naissance' à 'deces'
        'numero_acte' => $validated['numero_acte'],
        'date_acte' => $validated['date_acte'],
        'date_deces' => $validated['date_deces'], // Ajout de la date de décès
        'nombre_copie' => $validated['nombre_copie'],
        'statut' => 'en_attente',
    ]);

    return redirect()->route('demande.actedeces.details', [
        'acte' => $acte->id,
        'nombre_copie' => $validated['nombre_copie'],
        'demande_id' => $demande->id
    ]);
}

public function showActeDetailsActeDeces(ActeDeces $acte, Request $request)
{
    // Vérification supplémentaire du statut
    if ($acte->statut !== 'succès') {
        return redirect()->back()->withErrors(['statut' => 'Cet acte de décès n\'est pas encore disponible. Veuillez réessayer plus tard.']);
    }

    $nombre_copie = $request->query('nombre_copie', 1);
    $prix_copie = 500; // Prix par copie
    $frais = 200; // Frais par copie
    $total_copies = $nombre_copie * $prix_copie;
    $total_frais = $nombre_copie * $frais;
    $total_general = $total_copies + $total_frais;

    return view('frontend.demande.actedecesdetail', [
        'acte' => $acte,
        'nombre_copie' => $nombre_copie,
        'demande_id' => $request->query('demande_id'),
        'prix_copie' => $prix_copie,
        'frais' => $frais,
        'total_copies' => $total_copies,
        'total_frais' => $total_frais,
        'total_general' => $total_general
    ]);
}

//ACTE DE MARIAGE 

public function storeActeMariage(Request $request)
{
    $validated = $request->validate([
        'numero_acte' => 'required|string|max:50',
        'date_acte' => 'required|date',
        'date_mariage' => 'required|date',
        'nombre_copie' => 'required|integer|min:1|max:5',
    ]);

    // Recherche de l'acte avec les critères
    $acte = ActeMariage::where('numero_acte', $validated['numero_acte'])
                    ->where('date_acte', $validated['date_acte'])
                    ->where('date_mariage', $validated['date_mariage'])
                    ->first();

    if (!$acte) {
        return back()->withErrors([
            'numero_acte' => 'Aucun acte de mariage correspondant trouvé avec ces informations.',
        ])->withInput();
    }

    // Vérification du statut de l'acte
    if ($acte->statut !== 'succès') {
        return back()->withErrors([
            'numero_acte' => 'Cet acte de mariage n\'est pas encore validé. Statut: '.$acte->statut,
        ])->withInput();
    }

    $demande = Demande::create([
        'user_id' => Auth::id(),
        'acte_id' => $acte->id,
        'type_acte' => 'mariage',
        'numero_acte' => $validated['numero_acte'],
        'date_acte' => $validated['date_acte'],
        'date_mariage' => $validated['date_mariage'],
        'nombre_copie' => $validated['nombre_copie'],
        'statut' => 'en_attente',
    ]);

    return redirect()->route('demande.actemariage.details', [
        'acte' => $acte->id,
        'nombre_copie' => $validated['nombre_copie'],
        'demande_id' => $demande->id
    ]);
}

public function showActeDetailsActeMariage($id, Request $request)
{
    // Récupérer l'acte de mariage
    $acteMariage = ActeMariage::findOrFail($id);
    
    // Vérification du statut
    if ($acteMariage->statut !== 'succès') {
        return redirect()->back()->withErrors([
            'statut' => 'Cet acte de mariage n\'est pas encore disponible. Statut: '.$acteMariage->statut
        ]);
    }

    $nombre_copie = $request->query('nombre_copie', 1);
    $prix_copie = 500;
    $frais = 200;
    $total_copies = $nombre_copie * $prix_copie;
    $total_frais = $nombre_copie * $frais;
    $total_general = $total_copies + $total_frais;

    return view('frontend.demande.actemariagedetail', [
        'acteMariage' => $acteMariage, // Nom de variable corrigé
        'nombre_copie' => $nombre_copie,
        'demande_id' => $request->query('demande_id'),
        'prix_copie' => $prix_copie,
        'frais' => $frais,
        'total_copies' => $total_copies,
        'total_frais' => $total_frais,
        'total_general' => $total_general
    ]);
}

}