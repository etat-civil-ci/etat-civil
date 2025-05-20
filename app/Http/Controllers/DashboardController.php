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
        // Compteurs globaux
        $totalActesNaissance = ActeNaissance::count();
        $totalActesMarriage = ActeMariage::count();
        $totalActesDeces = ActeDeces::count();
        $totalCitoyens = User::where('role', 'citoyen')->count();
        
        // Statistiques des derniers 30 jours
        $dateDebut = Carbon::now()->subDays(30);
        
        $actesNaissanceMensuel = ActeNaissance::where('created_at', '>=', $dateDebut)->count();
        $actesMariageAnnuel = ActeMariage::where('created_at', '>=', Carbon::now()->startOfYear())->count();
        $actesDecesMensuel = ActeDeces::where('created_at', '>=', $dateDebut)->count();
        
        // Demandes récentes
        $demandesRecentes = Demande::with(['user', 'localite'])
                            ->orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();
        
        // Statistiques des demandes par statut
        $demandesParStatut = Demande::select('statut', DB::raw('count(*) as total'))
                            ->groupBy('statut')
                            ->get()
                            ->pluck('total', 'statut')
                            ->toArray();
        
        // Revenus
        $revenuTotal = Payment::sum('montant');
        $revenuMensuel = Payment::where('created_at', '>=', $dateDebut)->sum('montant');
        
        // Statistiques des téléchargements
        $downloadCount = DownloadHistory::count();
        
        // Données pour graphiques
        $statsDemandes = $this->getDemandesStats();
        $statsRevenu = $this->getRevenuStats();
        // $statsLocalites = $this->getLocalitesStats();
        
        return view('frontend.dash', compact(
            'totalActesNaissance', 
            'totalActesMarriage', 
            'totalActesDeces', 
            'totalCitoyens',
            'actesNaissanceMensuel',
            'actesMariageAnnuel',
            'actesDecesMensuel',
            'demandesRecentes',
            'demandesParStatut',
            'revenuTotal',
            'revenuMensuel',
            'downloadCount',
            'statsDemandes',
            'statsRevenu'
            // 'statsLocalites'
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