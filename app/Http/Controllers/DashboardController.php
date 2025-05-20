<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActeNaissance;
use App\Models\ActeMariage;
use App\Models\ActeDeces;
use App\Models\Demande;
use App\Models\User;
use App\Models\Payment;
use App\Models\DownloadHistory;
use App\Models\Localite;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $actesNaissanceMensuel = ActeNaissance::whereMonth('created_at', now()->month)->count();
        $totalActesNaissance = ActeNaissance::count();

        $actesMariageAnnuel = ActeMariage::whereYear('created_at', now()->year)->count();
        $totalActesMariage = ActeMariage::count();

        $actesDecesMensuel = ActeDeces::whereMonth('created_at', now()->month)->count();
        $totalActesDeces = ActeDeces::count();

        $totalCitoyens = User::count();

        // Statistiques des demandes (30 derniers jours)
        $demandes = Demande::where('created_at', '>=', now()->subDays(30))->get();

        $jours = [];
        $totaux = [];

        for ($i = 29; $i >= 0; $i--) {
            $jour = now()->subDays($i)->format('Y-m-d');
            $jours[] = $jour;
            $totaux[] = $demandes->whereBetween('created_at', [$jour . ' 00:00:00', $jour . ' 23:59:59'])->count();
        }

        $statsDemandes = [
            'jours' => $jours,
            'totaux' => $totaux
        ];

        // Statuts des demandes
        $demandesParStatut = [
            'validé' => Demande::where('statut', 'traitee')->count(),
            'en attente' => Demande::where('statut', 'en_attente')->count(),
            'annulé' => Demande::where('statut', 'rejetee')->count()
        ];

        // Revenus mensuels
        $mois = [];
        $totaux = [];

        for ($i = 1; $i <= 12; $i++) {
            $mois[] = Carbon::create()->month($i)->locale('fr_FR')->isoFormat('MMMM');
            $totaux[] = Payment::whereMonth('created_at', $i)
                                ->whereYear('created_at', now()->year)
                                ->sum('montant');
        }

        $statsRevenu = [
            'mois' => $mois,
            'totaux' => $totaux
        ];

        $revenuTotal = Payment::sum('montant');
        $revenuMensuel = Payment::whereMonth('created_at', now()->month)->sum('montant');

        // Top 5 localités avec le plus d’actes de naissance
        $topLocalitesData = ActeNaissance::select('localite_id', DB::raw('count(*) as total'))
            ->groupBy('localite_id')
            ->orderByDesc('total')
            ->with('localite')
            ->take(5)
            ->get();

        $topLocalites = [
            'noms' => $topLocalitesData->pluck('localite.nom'),
            'totaux' => $topLocalitesData->pluck('total')
        ];

        $demandesRecentes = Demande::latest()->take(10)->get();

        return view('admin.dash', compact(
            'actesNaissanceMensuel',
            'totalActesNaissance',
            'actesMariageAnnuel',
            'totalActesMariage',
            'actesDecesMensuel',
            'totalActesDeces',
            'totalCitoyens',
            'statsDemandes',
            'demandesParStatut',
            'statsRevenu',
            'revenuTotal',
            'revenuMensuel',
            'topLocalites',
            'demandesRecentes'
        ));
    }


    
    private function getDemandesStats()
    {
        // Récupérer les demandes par jour pour les 30 derniers jours
        $dateDebut = Carbon::now()->subDays(30);
        
        $demandes = Demande::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', $dateDebut)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
            
        $jours = [];
        $totaux = [];
        
        foreach ($demandes as $demande) {
            $jours[] = Carbon::parse($demande->date)->format('d/m');
            $totaux[] = $demande->total;
        }
        
        return [
            'jours' => $jours,
            'totaux' => $totaux
        ];
    }
    
    private function getRevenuStats()
    {
        // Récupérer les revenus par mois pour l'année courante
        $paiements = Payment::select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('sum(montant) as total')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('mois')
            ->orderBy('mois', 'asc')
            ->get();
            
        $mois = [];
        $totaux = [];
        
        $moisFrancais = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];
        
        // Initialiser tous les mois à 0
        for ($i = 1; $i <= 12; $i++) {
            $mois[] = $moisFrancais[$i];
            $totaux[] = 0;
        }
        
        // Remplir avec les données réelles
        foreach ($paiements as $paiement) {
            $totaux[$paiement->mois - 1] = $paiement->total;
        }
        
        return [
            'mois' => $mois,
            'totaux' => $totaux
        ];
    }
    
    // private function getLocalitesStats()
    // {
    //     // Récupérer les demandes par localité
    //     $demandesParLocalite = Demande::select(
    //             'localite_id',
    //             DB::raw('count(*) as total')
    //         )
    //         ->groupBy('localite_id')
    //         ->orderBy('total', 'desc')
    //         ->take(5)  // Top 5 des localités
    //         ->get();
        
    //     $noms = [];
    //     $totaux = [];
        
    //     foreach ($demandesParLocalite as $demande) {
    //         $localite = Localite::find($demande->localite_id);
    //         $noms[] = $localite ? $localite->nom : 'Inconnu';
    //         $totaux[] = $demande->total;
    //     }
        
    //     return [
    //         'noms' => $noms,
    //         'totaux' => $totaux
    //     ];
    // }
}