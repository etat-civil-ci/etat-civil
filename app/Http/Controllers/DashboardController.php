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
        // Statistiques des actes basées sur la table 'demandes'
        $actesNaissanceMensuel = Demande::where('type_acte', 'naissance')->whereMonth('created_at', now()->month)->count();
        $totalActesNaissance = Demande::where('type_acte', 'naissance')->count();

        $actesMariageAnnuel = Demande::where('type_acte', 'mariage')->whereYear('created_at', now()->year)->count();
        $totalActesMariage = Demande::where('type_acte', 'mariage')->count();

        $actesDecesMensuel = Demande::where('type_acte', 'deces')->whereMonth('created_at', now()->month)->count();
        $totalActesDeces = Demande::where('type_acte', 'deces')->count();

        $totalCitoyens = User::count();

        // Statistiques des demandes (30 derniers jours)
        // Utilisation de la méthode privée pour obtenir les stats des demandes
        $statsDemandes = $this->getDemandesStats();

        // Statuts des demandes (utilisation des valeurs d'enum de la DB)
        $demandesParStatut = [
            'traitee' => Demande::where('statut', 'traitee')->count(),
            'en_attente' => Demande::where('statut', 'en_attente')->count(),
            'rejetee' => Demande::where('statut', 'rejetee')->count()
        ];

        // Revenus mensuels
        // Utilisation de la méthode privée pour obtenir les stats des revenus
        $statsRevenu = $this->getRevenuStats();

        $revenuTotal = Payment::sum('montant');
        $revenuMensuel = Payment::whereMonth('created_at', now()->month)->sum('montant');

        // Top 5 localités - Maintenant que localite_id est dans 'demandes', nous pouvons joindre les tables.
        // Utilisation de la méthode privée pour obtenir les stats des localités
        $topLocalites = $this->getLocalitesStats();

        // Demandes récentes - Charger la relation 'user' pour accéder au nom de l'utilisateur
        $demandesRecentes = Demande::with('user')->latest()->take(10)->get();

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

    /**
     * Récupère les statistiques des demandes par jour pour les 30 derniers jours.
     * @return array Un tableau contenant les jours et les totaux des demandes.
     */
    private function getDemandesStats()
    {
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
        
        // Initialise tous les jours des 30 derniers jours à 0
        for ($i = 29; $i >= 0; $i--) {
            $jours[] = Carbon::now()->subDays($i)->format('d/m');
            // Trouver le total pour ce jour, sinon 0
            $found = false;
            foreach ($demandes as $demande) {
                if (Carbon::parse($demande->date)->format('d/m') === Carbon::now()->subDays($i)->format('d/m')) {
                    $totaux[] = $demande->total;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $totaux[] = 0;
            }
        }
        
        return [
            'jours' => $jours,
            'totaux' => $totaux
        ];
    }
    
    /**
     * Récupère les revenus mensuels pour l'année courante.
     * @return array Un tableau contenant les mois et les totaux des revenus.
     */
    private function getRevenuStats()
    {
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
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];
        
        // Initialiser tous les mois à 0 pour s'assurer que tous les mois sont représentés
        for ($i = 1; $i <= 12; $i++) {
            $mois[] = $moisFrancais[$i];
            $totaux[] = 0;
        }
        
        // Remplir avec les données réelles des paiements
        foreach ($paiements as $paiement) {
            // Ajuste l'index car les mois sont de 1 à 12, et les tableaux de 0 à 11
            $totaux[$paiement->mois - 1] = $paiement->total;
        }
        
        return [
            'mois' => $mois,
            'totaux' => $totaux
        ];
    }
    
    /**
     * Récupère les statistiques des demandes par localité.
     * @return array Un tableau contenant les noms des localités et les totaux des demandes.
     */
    private function getLocalitesStats()
    {
        // Récupérer les demandes par localité en joignant les tables
        $demandesParLocalite = Demande::join('localite', 'demandes.localite_id', '=', 'localite.id')
            ->select('localite.nom as nom_localite', DB::raw('count(demandes.id) as total_demandes'))
            ->groupBy('localite.nom')
            ->orderBy('total_demandes', 'desc')
            ->take(5)
            ->get();

        $noms = $demandesParLocalite->pluck('nom_localite')->toArray();
        $totaux = $demandesParLocalite->pluck('total_demandes')->toArray();
        
        return [
            'noms' => $noms,
            'totaux' => $totaux
        ];
    }
}












// class DashboardController extends Controller
// {

//     public function index()
//     {
//         $actesNaissanceMensuel = ActeNaissance::whereMonth('created_at', now()->month)->count();
//         $totalActesNaissance = ActeNaissance::count();

//         $actesMariageAnnuel = ActeMariage::whereYear('created_at', now()->year)->count();
//         $totalActesMariage = ActeMariage::count();

//         $actesDecesMensuel = ActeDeces::whereMonth('created_at', now()->month)->count();
//         $totalActesDeces = ActeDeces::count();

//         $totalCitoyens = User::count();

//         // Statistiques des demandes (30 derniers jours)
//         $demandes = Demande::where('created_at', '>=', now()->subDays(30))->get();

//         $jours = [];
//         $totaux = [];

//         for ($i = 29; $i >= 0; $i--) {
//             $jour = now()->subDays($i)->format('Y-m-d');
//             $jours[] = $jour;
//             $totaux[] = $demandes->whereBetween('created_at', [$jour . ' 00:00:00', $jour . ' 23:59:59'])->count();
//         }

//         $statsDemandes = [
//             'jours' => $jours,
//             'totaux' => $totaux
//         ];

//         // Statuts des demandes
//         $demandesParStatut = [
//             'validé' => Demande::where('statut', 'traitee')->count(),
//             'en attente' => Demande::where('statut', 'en_attente')->count(),
//             'annulé' => Demande::where('statut', 'rejetee')->count()
//         ];

//         // Revenus mensuels
//         $mois = [];
//         $totaux = [];

//         for ($i = 1; $i <= 12; $i++) {
//             $mois[] = Carbon::create()->month($i)->locale('fr_FR')->isoFormat('MMMM');
//             $totaux[] = Payment::whereMonth('created_at', $i)
//                                 ->whereYear('created_at', now()->year)
//                                 ->sum('montant');
//         }

//         $statsRevenu = [
//             'mois' => $mois,
//             'totaux' => $totaux
//         ];

//         $revenuTotal = Payment::sum('montant');
//         $revenuMensuel = Payment::whereMonth('created_at', now()->month)->sum('montant');

//         // Top 5 localités avec le plus d’actes de naissance
//         $topLocalitesData = ActeNaissance::select('localite_id', DB::raw('count(*) as total'))
//             ->groupBy('localite_id')
//             ->orderByDesc('total')
//             ->with('localite')
//             ->take(5)
//             ->get();

//         $topLocalites = [
//             'noms' => $topLocalitesData->pluck('localite.nom'),
//             'totaux' => $topLocalitesData->pluck('total')
//         ];

//         $demandesRecentes = Demande::latest()->take(10)->get();

//         return view('admin.dash', compact(
//             'actesNaissanceMensuel',
//             'totalActesNaissance',
//             'actesMariageAnnuel',
//             'totalActesMariage',
//             'actesDecesMensuel',
//             'totalActesDeces',
//             'totalCitoyens',
//             'statsDemandes',
//             'demandesParStatut',
//             'statsRevenu',
//             'revenuTotal',
//             'revenuMensuel',
//             'topLocalites',
//             'demandesRecentes'
//         ));
//     }


    
//     private function getDemandesStats()
//     {
//         // Récupérer les demandes par jour pour les 30 derniers jours
//         $dateDebut = Carbon::now()->subDays(30);
        
//         $demandes = Demande::select(
//                 DB::raw('DATE(created_at) as date'),
//                 DB::raw('count(*) as total')
//             )
//             ->where('created_at', '>=', $dateDebut)
//             ->groupBy('date')
//             ->orderBy('date', 'asc')
//             ->get();
            
//         $jours = [];
//         $totaux = [];
        
//         foreach ($demandes as $demande) {
//             $jours[] = Carbon::parse($demande->date)->format('d/m');
//             $totaux[] = $demande->total;
//         }
        
//         return [
//             'jours' => $jours,
//             'totaux' => $totaux
//         ];
//     }
    
//     private function getRevenuStats()
//     {
//         // Récupérer les revenus par mois pour l'année courante
//         $paiements = Payment::select(
//                 DB::raw('MONTH(created_at) as mois'),
//                 DB::raw('sum(montant) as total')
//             )
//             ->whereYear('created_at', Carbon::now()->year)
//             ->groupBy('mois')
//             ->orderBy('mois', 'asc')
//             ->get();
            
//         $mois = [];
//         $totaux = [];
        
//         $moisFrancais = [
//             1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
//             5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
//             9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
//         ];
        
//         // Initialiser tous les mois à 0
//         for ($i = 1; $i <= 12; $i++) {
//             $mois[] = $moisFrancais[$i];
//             $totaux[] = 0;
//         }
        
//         // Remplir avec les données réelles
//         foreach ($paiements as $paiement) {
//             $totaux[$paiement->mois - 1] = $paiement->total;
//         }
        
//         return [
//             'mois' => $mois,
//             'totaux' => $totaux
//         ];
//     }
    
//     // private function getLocalitesStats()
//     // {
//     //     // Récupérer les demandes par localité
//     //     $demandesParLocalite = Demande::select(
//     //             'localite_id',
//     //             DB::raw('count(*) as total')
//     //         )
//     //         ->groupBy('localite_id')
//     //         ->orderBy('total', 'desc')
//     //         ->take(5)  // Top 5 des localités
//     //         ->get();
        
//     //     $noms = [];
//     //     $totaux = [];
        
//     //     foreach ($demandesParLocalite as $demande) {
//     //         $localite = Localite::find($demande->localite_id);
//     //         $noms[] = $localite ? $localite->nom : 'Inconnu';
//     //         $totaux[] = $demande->total;
//     //     }
        
//     //     return [
//     //         'noms' => $noms,
//     //         'totaux' => $totaux
//     //     ];
//     // }
// }