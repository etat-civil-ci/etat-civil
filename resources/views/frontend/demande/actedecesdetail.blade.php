<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'Acte de Décès</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- =======================
Détails de l'acte START -->
<section class="pt-5">
    <div class="container">
        <!-- En-tête -->
        <div class="bg-dark rounded-4 text-center position-relative overflow-hidden py-5 mb-5">
            <h1 class="h2 text-white">Détails de l'Acte de Décès</h1>
            <p class="text-white-50 mb-0">Référence: {{ $acte->numero_acte }}</p>
        </div>

        <!-- Détails de l'acte -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-certificate me-2"></i>Certificat d'Acte de Décès
                    </h3>
                    <span class="badge bg-light text-dark fs-6">
                        <i class="fas fa-copy me-1"></i> {{ $nombre_copie }} copie(s)
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Défunt -->
                    <div class="col-md-6 border-end">
                        <h4 class="text-primary mb-4 border-bottom pb-2">
                            <i class="fas fa-user-times me-2"></i>Informations du Défunt
                        </h4>
                        <div class="ps-3">
                            <p><strong>Nom complet:</strong> {{ $acte->nom_defunt }} {{ $acte->prenom_defunt }}</p>
                            <p><strong>Date de décès:</strong> {{ $acte->date_deces ? \Carbon\Carbon::parse($acte->date_deces)->format('d/m/Y') : '' }}</p>
                            <p><strong>Lieu de décès:</strong> {{ $acte->lieu_deces }}</p>
                            <p><strong>Date de naissance:</strong> {{ $acte->date_naissance ? $acte->date_naissance->format('d/m/Y') : 'Non renseignée' }}</p>
                            <p><strong>Lieu de naissance:</strong> {{ $acte->lieu_naissance ?? 'Non renseigné' }}</p>
                            <p><strong>Cause du décès:</strong> {{ $acte->cause_deces ?? 'Non renseignée' }}</p>
                        </div>
                    </div>

                    <!-- Déclarant et Parents -->
                    <div class="col-md-6">
                        <h4 class="text-primary mb-4 border-bottom pb-2">
                            <i class="fas fa-user-edit me-2"></i>Informations du Déclarant
                        </h4>
                        <div class="ps-3">
                            <p><strong>Nom complet:</strong> {{ $acte->nom_declarant }} {{ $acte->prenom_declarant }}</p>
                            <p><strong>Filiation:</strong> {{ $acte->filiation }}</p>
                            
                            <h5 class="mt-4 text-primary"><i class="fas fa-users me-2"></i>Parents</h5>
                            @if($acte->type_parent && $acte->nom_parent)
                                <p><strong>{{ ucfirst($acte->type_parent) }}:</strong> {{ $acte->nom_parent }} {{ $acte->prenom_parent }}</p>
                            @else
                                <p><strong>Parents:</strong> Non renseignés</p>
                            @endif
                            
                            <div class="mt-4">
                                <h5 class="text-primary"><i class="fas fa-file-alt me-2"></i>Détails de l'Acte</h5>
                                <p><strong>Date d'enregistrement:</strong> {{ $acte->date_acte ? \Carbon\Carbon::parse($acte->date_acte)->format('d/m/Y') : '' }}</p>
                                <p><strong>Numéro d'acte:</strong> {{ $acte->numero_acte }}</p>
                                <p><strong>Statut:</strong> 
                                    <span class="badge bg-{{ $acte->statut === 'succès' ? 'success' : ($acte->statut === 'échec' ? 'danger' : 'warning') }}">
                                        {{ $acte->statut }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails de la Demande -->
                <div class="mt-5 pt-4 border-top">
                    <h4 class="text-primary mb-3">
                        <i class="fas fa-file-alt me-2"></i>Détails de la Demande
                    </h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Date de demande:</strong> {{ now()->format('d/m/Y H:i') }}</p>
                            <p><strong>Nombre de copies:</strong> {{ $nombre_copie }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Statut:</strong> <span class="badge bg-warning text-dark">En traitement</span></p>
                            <p><strong>Prix par copie:</strong> {{ number_format($prix_copie, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Référence demande:</strong> #{{ $demande_id ?? 'N/A' }}</p>
                            <p><strong>Frais par copie:</strong> {{ number_format($frais, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                    
                    <!-- Section Calcul des coûts -->
                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-3">
                            <div class="card border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Détail du calcul</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Coût des copies ({{ $nombre_copie }} × {{ number_format($prix_copie, 0, ',', ' ') }} FCFA)</td>
                                            <td class="text-end">{{ number_format($total_copies, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de dossier ({{ $nombre_copie }} × {{ number_format($frais, 0, ',', ' ') }} FCFA)</td>
                                            <td class="text-end">{{ number_format($total_frais, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                        <tr class="table-active">
                                            <th>Total à payer</th>
                                            <th class="text-end">{{ number_format($total_general, 0, ',', ' ') }} FCFA</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="text-center mt-4">
                    <a href="{{ route('demandes.acte-deces.create') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                    <a href="{{ route('demandes.paiement.create', ['demande_id' => $demande_id]) }}" class="btn btn-primary me-2">
                        <i class="fas fa-credit-card"></i> Procéder au paiement
                    </a>
                    <button class="btn btn-success">
                        <i class="fas fa-print"></i> Imprimer la demande
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Détails de l'acte END -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>