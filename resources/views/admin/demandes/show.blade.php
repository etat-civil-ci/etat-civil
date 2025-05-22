@extends('layouts.app')

@section('title', 'Détails de la Demande | Système de Gestion de l\'État Civil')

@section('styles')
<style>
    /* Styles pour la chronologie */
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e0e0e0;
        left: 20px;
        margin-left: -1px;
    }

    .timeline-item {
        margin-bottom: 20px;
        position: relative;
        padding-left: 60px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: #007bff;
        border-radius: 50%;
        left: 16px;
        top: 5px;
        z-index: 1;
    }

    .timeline-content {
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* Styles pour les cards */
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #e9ecef;
        font-weight: bold;
    }

    /* Styles pour les informations du demandeur */
    .img-thumbnail {
        border: 2px solid #ddd;
    }

    /* Styles pour les badges de statut */
    .badge-traitee { background-color: #28a745; color: white; }
    .badge-en_attente { background-color: #ffc107; color: #343a40; }
    .badge-rejetee { background-color: #dc3545; color: white; }

    /* Styles pour la modale de confirmation */
    .fixed.inset-0 {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
    .bg-gray-600 { background-color: #4a5568; }
    .bg-opacity-50 { opacity: 0.5; }
    .overflow-y-auto { overflow-y: auto; }
    .h-full { height: 100%; }
    .w-full { width: 100%; }
    .hidden { display: none; }
    .z-50 { z-index: 50; }
    .relative.top-20 { position: relative; top: 5rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
    .p-5 { padding: 1.25rem; }
    .border { border-width: 1px; }
    .w-96 { width: 24rem; }
    .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
    .rounded-md { border-radius: 0.375rem; }
    .bg-white { background-color: #fff; }
    .mt-3 { margin-top: 0.75rem; }
    .text-center { text-align: center; }
    .text-lg { font-size: 1.125rem; }
    .leading-6 { line-height: 1.5rem; }
    .font-medium { font-weight: 500; }
    .text-gray-900 { color: #1a202c; }
    .mt-2 { margin-top: 0.5rem; }
    .px-7 { padding-left: 1.75rem; padding-right: 1.75rem; }
    .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
    .text-sm { font-size: 0.875rem; }
    .text-gray-500 { color: #a0aec0; }
    .items-center { align-items: center; }
    .px-4 { padding-left: 1rem; padding-right: 1rem; }
    .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
    .bg-green-500 { background-color: #48bb78; }
    .text-white { color: #fff; }
    .text-base { font-size: 1rem; }
    .font-medium { font-weight: 500; }
    .rounded-md { border-radius: 0.375rem; }
    .w-full { width: 100%; }
    .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .hover\:bg-green-700:hover { background-color: #2f855a; }
    .focus\:outline-none:focus { outline: 0; }
    .focus\:ring-2:focus { box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.5); } /* Example ring color */
    .focus\:ring-green-500:focus { box-shadow: 0 0 0 2px rgba(72, 187, 120, 0.5); }
    .mt-3 { margin-top: 0.75rem; }
    .bg-gray-300 { background-color: #e2e8f0; }
    .text-gray-800 { color: #2d3748; }
    .hover\:bg-gray-400:hover { background-color: #cbd5e0; }
    .focus\:ring-gray-300:focus { box-shadow: 0 0 0 2px rgba(226, 232, 240, 0.5); }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Détails de la Demande</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('demandes.index') }}">Demandes</a></li>
        <li class="breadcrumb-item active">Détails</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Informations de la Demande
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Type d'acte:</div>
                        <div class="col-md-8">{{ $demande->type_acte }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Numéro d'acte:</div>
                        <div class="col-md-8">{{ $demande->numero_acte }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Date d'acte:</div>
                        <div class="col-md-8">{{ $demande->date_acte->format('d/m/Y') }}</div>
                    </div>
                    @if($demande->date_deces)
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Date de décès:</div>
                        <div class="col-md-8">{{ $demande->date_deces->format('d/m/Y') }}</div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Nombre de copies:</div>
                        <div class="col-md-8">{{ $demande->nombre_copie }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Statut:</div>
                        <div class="col-md-8">
                            @if($demande->statut == 'traitee')
                                <span class="badge badge-traitee">Traitée</span>
                            @elseif($demande->statut == 'en_attente')
                                <span class="badge badge-en_attente">En attente</span>
                            @else
                                <span class="badge badge-rejetee">Rejetée</span>
                            @endif
                        </div>
                    </div>
                    @if($demande->motif_rejet)
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Motif de rejet:</div>
                        <div class="col-md-8">{{ $demande->motif_rejet }}</div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Date de création:</div>
                        <div class="col-md-8">{{ $demande->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Dernière mise à jour:</div>
                        <div class="col-md-8">{{ $demande->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                    @if($demande->localite)
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Localité:</div>
                        <div class="col-md-8">{{ $demande->localite->nom }}</div>
                    </div>
                    @endif
                </div>
            </div>

            @if($demande->payment)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-money-bill-wave me-1"></i>
                    Informations de Paiement
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Montant:</div>
                        <div class="col-md-8">{{ number_format($demande->payment->montant, 0, ',', ' ') }} FCFA</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Opérateur:</div>
                        <div class="col-md-8">{{ $demande->payment->operateur }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Numéro de téléphone:</div>
                        <div class="col-md-8">{{ $demande->payment->numero_telephone }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Référence transaction:</div>
                        <div class="col-md-8">{{ $demande->payment->reference_transaction }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Statut du paiement:</div>
                        <div class="col-md-8">{{ $demande->payment->statut }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Date de paiement:</div>
                        <div class="col-md-8">{{ $demande->payment->date_paiement->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-history me-1"></i>
                    Historique de la Demande
                </div>
                <div class="card-body">
                    <div class="timeline">
                        {{-- Étape 1: Demande créée --}}
                        @if($demande->created_at)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $demande->created_at->format('d/m/Y à H:i') }}</div>
                            <div class="timeline-content">
                                <h5>Demande créée</h5>
                                <p>La demande a été initialement soumise.</p>
                            </div>
                        </div>
                        @endif
                        
                        {{-- Étape 2: Statut mis à jour (ceci inclut les changements de 'en_attente' à 'traitee' ou 'rejetee') --}}
                        {{-- L'élément que vous aviez au début du fichier est intégré ici --}}
                        @if($demande->updated_at && $demande->updated_at->gt($demande->created_at))
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $demande->updated_at->format('d/m/Y à H:i') }}</div>
                            <div class="timeline-content">
                                <h5>Statut mis à jour</h5>
                                <p>La demande a été marquée comme : 
                                    @if($demande->statut == 'traitee')
                                        <span class="badge badge-traitee">Traitée</span>
                                    @elseif($demande->statut == 'en_attente')
                                        <span class="badge badge-en_attente">En attente</span>
                                    @else
                                        <span class="badge badge-rejetee">Rejetée</span>
                                    @endif
                                </p>
                                @if($demande->motif_rejet)
                                    <p>Motif de rejet: {{ $demande->motif_rejet }}</p>
                                @endif
                            </div>
                        </div>
                        @endif
                                                
                        {{-- Étape 3: Document téléchargé (si applicable) --}}
                        @if($demande->statut == 'traitee' && $demande->downloadHistory && $demande->downloadHistory->count() > 0)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $demande->downloadHistory->first()->created_at->format('d/m/Y à H:i') }}</div>
                            <div class="timeline-content">
                                <h5>Document téléchargé</h5>
                                <p>Le document a été téléchargé pour la première fois.</p>
                            </div>
                        </div>
                        @endif
                    </div> </div>
            </div>

            @if($demande->statut == 'traitee') {{-- Correction: validé -> traitee --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-pdf me-1"></i>
                    Aperçu du document
                </div>
                <div class="card-body">
                    <div class="document-preview">
                        <div class="text-center">
                            <img src="{{ asset('img/document-preview.png') }}" alt="Aperçu du document" class="img-fluid" style="max-height: 300px;">
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Informations du demandeur
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{ $demande->user->photo ? asset('storage/'.$demande->user->photo) : asset('img/default-user.png') }}" 
                             alt="Photo de profil" class="rounded-circle img-thumbnail" style="width: 100px; height: 100px;">
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Nom & Prénom:</div>
                        <div class="col-md-8">{{ $demande->user->name }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $demande->user->email }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Téléphone:</div>
                        <div class="col-md-8">{{ $demande->user->contact }}</div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('users.show', $demande->user->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-user"></i> Voir le profil complet
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tasks me-1"></i>
                    Actions
                </div>
                <div class="card-body">
                    <div class="action-buttons">
                        @if($demande->statut == 'en_attente')
                        <form action="{{ route('demandes.valider', $demande->id) }}" method="POST" class="mb-2 confirm-action" data-confirm-message="Êtes-vous sûr de vouloir valider cette demande ?">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check"></i> Valider la demande
                            </button>
                        </form>
                        
                        <form action="{{ route('demandes.rejeter', $demande->id) }}" method="POST" class="mb-2 confirm-action" data-confirm-message="Êtes-vous sûr de vouloir rejeter cette demande ?">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-times"></i> Rejeter la demande
                            </button>
                        </form>
                        @endif
                        
                        @if($demande->statut == 'traitee')
                        <a href="{{ route('demandes.telecharger', $demande->id) }}" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-download"></i> Télécharger le document
                        </a>
                        
                        <a href="{{ route('demandes.envoyer', $demande->id) }}" class="btn btn-info w-100 mb-2">
                            <i class="fas fa-paper-plane"></i> Envoyer par email
                        </a>
                        @endif
                        
                        <a href="{{ route('demandes.edit', $demande->id) }}" class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                    </div>
                    
                    <hr>
                    
                    <div class="notes">
                        <h6>Notes administratives:</h6>
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <textarea class="form-control" name="note" rows="3" placeholder="Ajouter une note..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary">
                                <i class="fas fa-save"></i> Enregistrer la note
                            </button>
                        </form>
                        
                        @if($demande->notes && count($demande->notes) > 0)
                        <div class="mt-3">
                            @foreach($demande->notes as $note)
                            <div class="alert alert-secondary">
                                <small class="text-muted">{{ $note->created_at->format('d/m/Y H:i') }} - {{ $note->admin->name ?? 'Admin Inconnu' }}</small>
                                <p class="mb-0">{{ $note->contenu }}</p>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Confirmation Modal (remplace confirm()) --}}
<div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Confirmation</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="modalMessage">Êtes-vous sûr de vouloir effectuer cette action ?</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmBtn" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Confirmer</button>
                <button id="cancelBtn" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">Annuler</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Script pour confirmation des actions (remplacé par une modale personnalisée)
    document.addEventListener('DOMContentLoaded', function() {
        const confirmationModal = document.getElementById('confirmationModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        let currentForm = null;

        document.querySelectorAll('form.confirm-action').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Empêche la soumission par défaut
                currentForm = this; // Stocke la référence au formulaire actuel

                // Personnalise le message de la modale
                modalMessage.textContent = this.dataset.confirmMessage || 'Êtes-vous sûr de vouloir effectuer cette action ?';
                
                // Affiche la modale
                confirmationModal.classList.remove('hidden');
            });
        });

        confirmBtn.addEventListener('click', function() {
            if (currentForm) {
                confirmationModal.classList.add('hidden'); // Cache la modale
                currentForm.submit(); // Soumet le formulaire
            }
        });

        cancelBtn.addEventListener('click', function() {
            confirmationModal.classList.add('hidden'); // Cache la modale
            currentForm = null; // Réinitialise le formulaire
        });
    });
</script>
@endsection
