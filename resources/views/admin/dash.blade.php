@extends('layouts.app')

@section('title', 'Tableau de Bord | Système de Gestion de l\'État Civil')

@section('styles')
<style>
    .stats-card {
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-card .icon {
        font-size: 40px;
        margin-bottom: 15px;
    }
    
    .stats-card .number {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .stats-card .label {
        font-size: 16px;
        color: #777;
    }
    
    .card-green {
        background-color: #ebfaeb;
        border-left: 4px solid #28a745;
    }
    
    .card-red {
        background-color: #ffebeb;
        border-left: 4px solid #dc3545;
    }
    
    .card-blue {
        background-color: #e6f2ff;
        border-left: 4px solid #007bff;
    }
    
    .card-orange {
        background-color: #fff2e6;
        border-left: 4px solid #fd7e14;
    }
    
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    /* Mise à jour des classes de badge pour correspondre aux statuts de la DB */
    .badge-traitee {
        background-color: #28a745;
        color: white;
    }
    
    .badge-en_attente {
        background-color: #ffc107;
        color: #343a40;
    }
    
    .badge-rejetee {
        background-color: #dc3545;
        color: white;
    }
    
    .chart-container {
        height: 300px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<section class="pt-8">
    <div class="container-fluid px-4">
    
            <div class="bg-dark rounded-4 text-center position-relative overflow-hidden py-5">
            <figure class="position-absolute top-0 start-0 ms-n8">
                <svg width="424" height="405" viewBox="0 0 424 405" fill="none" xmlns="http://www.w3.org/2000/svg">
                    </svg>
            </figure>

            <figure class="position-absolute top-0 end-0 me-n8 mt-5">
                <svg class="opacity-3" width="371" height="354" viewBox="0 0 371 354" fill="none" xmlns="http://www.w3.org/2000/svg">
                    </svg>
            </figure>

            <div class="d-flex justify-content-center position-relative z-index-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <h1 class="h2 text-white">Tableau de Bord</h1>
        </div>
            <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Vue d'ensemble du système</li>
        </ol>
        
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-green">
                    <div class="icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <div class="number">{{ $actesNaissanceMensuel }}</div>
                    <div class="label">ACTES DE NAISSANCE (MENSUELS)</div>
                    <div class="total">Total: {{ $totalActesNaissance }}</div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-red">
                    <div class="icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="number">{{ $actesMariageAnnuel }}</div>
                    <div class="label">ACTES DE MARIAGE (ANNUELS)</div>
                    <div class="total">Total: {{ $totalActesMariage }}</div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-blue">
                    <div class="icon">
                        <i class="fas fa-bible"></i>
                    </div>
                    <div class="number">{{ $actesDecesMensuel }}</div>
                    <div class="label">ACTES DE DÉCÈS</div>
                    <div class="total">Total: {{ $totalActesDeces }}</div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-orange">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="number">{{ $totalCitoyens }}</div>
                    <div class="label">CITOYENS</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Évolution des demandes (30 derniers jours)
                    </div>
                    <div class="card-body">
                        <canvas id="demandesChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        État des demandes
                    </div>
                    <div class="card-body">
                        <canvas id="statutsChart" class="chart-container"  width="600" height="400"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <span class="badge badge-traitee">Traitée</span>
                            <span>{{ $demandesParStatut['traitee'] ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="badge badge-en_attente">En attente</span>
                            <span>{{ $demandesParStatut['en_attente'] ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="badge badge-rejetee">Rejetée</span>
                            <span>{{ $demandesParStatut['rejetee'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-1"></i>
                        Revenus par mois ({{ date('Y') }})
                    </div>
                    <div class="card-body">
                        <canvas id="revenuChart" class="chart-container"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <strong>Revenu total:</strong> {{ number_format($revenuTotal, 0, ',', ' ') }} FCFA
                        </div>
                        <div>
                            <strong>Revenu mensuel:</strong> {{ number_format($revenuMensuel, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        Top 5 des localités
                    </div>
                    <div class="card-body">
                        <canvas id="localitesChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Demandes récentes
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="demandesTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>N°</th>
                                <th>Nom & Prénom</th>
                                <th>Date</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demandesRecentes as $demande)
                            <tr>
                                <td>{{ $demande->id }}</td>
                                {{-- Utilisation de $demande->user->name car le schéma 'users' a une colonne 'name' --}}
                                <td>{{ $demande->user->name }}</td> 
                                <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                                <td>{{ $demande->user->role }}</td>
                                <td>
                                    {{-- Mise à jour des badges pour correspondre aux statuts de la DB --}}
                                    @if($demande->statut == 'traitee')
                                        <span class="badge badge-traitee">Traitée</span>
                                    @elseif($demande->statut == 'en_attente')
                                        <span class="badge badge-en_attente">En attente</span>
                                    @else
                                        <span class="badge badge-rejetee">Rejetée</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Ajoutez ici les actions pour chaque demande --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // --- DÉBUT DES VÉRIFICATIONS DE DIAGNOSTIC ---
    console.log("--- Début de l'exécution du script dash.blade.php ---");

    if (typeof Chart === 'undefined') {
        console.error("ERREUR: La bibliothèque Chart.js n'est pas chargée. Vérifiez l'URL du CDN ou votre connexion.");
    } else {
        console.log("Chart.js est chargé avec succès.");
    }

    if (typeof jQuery === 'undefined') {
        console.warn("AVERTISSEMENT: jQuery n'est pas chargé. La DataTable pourrait ne pas fonctionner.");
    } else {
        console.log("jQuery est chargé avec succès.");
    }
    console.log("--- Fin des vérifications initiales ---");
    // --- FIN DES VÉRIFICATIONS DE DIAGNOSTIC ---

    // Configuration des couleurs
    const colors = {
        green: 'rgba(40, 167, 69, 0.7)',
        red: 'rgba(220, 53, 69, 0.7)',
        blue: 'rgba(0, 123, 255, 0.7)',
        orange: 'rgba(253, 126, 20, 0.7)',
        yellow: 'rgba(255, 193, 7, 0.7)',
        teal: 'rgba(32, 201, 151, 0.7)',
        purple: 'rgba(111, 66, 193, 0.7)',
        indigo: 'rgba(102, 16, 242, 0.7)',
    };
    
    // Graphique des demandes
    try {
        const demandesCtx = document.getElementById('demandesChart').getContext('2d');
        const demandesLabels = @json($statsDemandes['jours']);
        const demandesData = @json($statsDemandes['totaux']);

        console.log('Données pour le graphique des demandes (labels):', demandesLabels);
        console.log('Données pour le graphique des demandes (data):', demandesData);

        new Chart(demandesCtx, {
            type: 'line',
            data: {
                labels: demandesLabels,
                datasets: [{
                    label: 'Nombre de demandes',
                    data: demandesData,
                    backgroundColor: colors.blue,
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Erreur lors de la création du graphique des demandes:', error);
    }
    
    // Graphique des statuts de demandes
    try {
        const statutsCtx = document.getElementById('statutsChart').getContext('2d');
        const statutsData = [
            {{ $demandesParStatut['traitee'] ?? 0 }},
            {{ $demandesParStatut['en_attente'] ?? 0 }},
            {{ $demandesParStatut['rejetee'] ?? 0 }}
        ];

        console.log('Données pour le graphique des statuts:', statutsData);

        new Chart(statutsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Traitée', 'En attente', 'Rejetée'], // Labels mis à jour
                datasets: [{
                    data: statutsData,
                    backgroundColor: [
                        colors.green,
                        colors.yellow,
                        colors.red
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    } catch (error) {
        console.error('Erreur lors de la création du graphique des statuts:', error);
    }
    
    // Graphique des revenus
    try {
        const revenuCtx = document.getElementById('revenuChart').getContext('2d');
        const revenuLabels = @json($statsRevenu['mois']);
        const revenuData = @json($statsRevenu['totaux']);

        console.log('Données pour le graphique des revenus (labels):', revenuLabels);
        console.log('Données pour le graphique des revenus (data):', revenuData);

        new Chart(revenuCtx, {
            type: 'bar',
            data: {
                labels: revenuLabels, // Utilise les noms complets des mois
                datasets: [{
                    label: 'Revenu mensuel (FCFA)',
                    data: revenuData,
                    backgroundColor: colors.green,
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    } catch (error) {
        console.error('Erreur lors de la création du graphique des revenus:', error);
    }
    
    // Graphique des localités
    try {
        const localitesCtx = document.getElementById('localitesChart').getContext('2d');
        const localitesLabels = @json($topLocalites['noms']);
        const localitesData = @json($topLocalites['totaux']);

        console.log('Données pour le graphique des localités (labels):', localitesLabels);
        console.log('Données pour le graphique des localités (data):', localitesData);

        new Chart(localitesCtx, {
            type: 'pie', // Vous pouvez changer le type de graphique ici (ex: 'bar')
            data: {
                labels: localitesLabels,
                datasets: [{
                    label: 'Nombre d\'actes',
                    data: localitesData,
                    backgroundColor: [
                        colors.blue,
                        colors.purple,
                        colors.teal,
                        colors.orange,
                        colors.indigo
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    } catch (error) {
        console.error('Erreur lors de la création du graphique des localités:', error);
    }
   
    // DataTable pour les demandes
    $(document).ready(function() {
        $('#demandesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            },
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]]
        });
    });
</script>
@endsection
