<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'Acte de Mariage</title>
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
            <h1 class="h2 text-white">Détails de l'Acte de Mariage</h1>
            <p class="text-white-50 mb-0">Référence: {{ $acteMariage->numero_acte }}</p>
        </div>

        <!-- Détails de l'acte -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-certificate me-2"></i>Certificat d'Acte de Mariage
                    </h3>
                    <span class="badge bg-light text-dark fs-6">
                        <i class="fas fa-copy me-1"></i> {{ $nombre_copie }} copie(s)
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Époux -->
                    <div class="col-md-6 border-end">
                        <h4 class="text-primary mb-4 border-bottom pb-2">
                            <i class="fas fa-user me-2"></i>Informations de l'Époux
                        </h4>
                        <div class="ps-3">
                            <p><strong>Nom complet:</strong> {{ $acteMariage->nom_epoux }} {{ $acteMariage->prenom_epoux }}</p>
                            <p><strong>Date de naissance:</strong> {{ $acteMariage->date_naissance_epoux ? \Carbon\Carbon::parse($acteMariage->date_naissance_epoux)->format('d/m/Y') : '' }}</p>
                            <p><strong>Lieu de naissance:</strong> {{ $acteMariage->lieu_naissance_epoux }}</p>
                            <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_epoux }}</p>
                            <p><strong>Profession:</strong> {{ $acteMariage->profession_epoux }}</p>
                            <p><strong>Domicile:</strong> {{ $acteMariage->domicile_epoux }}</p>
                            
                            <!-- Documents époux -->
                            <div class="mt-3">
                                <h5 class="text-primary"><i class="fas fa-file-alt me-2"></i>Documents</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ asset('storage/'.$acteMariage->extrait_naissance_epoux) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-pdf"></i> Extrait naissance
                                    </a>
                                    <a href="{{ asset('storage/'.$acteMariage->photo_epoux) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-image"></i> Photo
                                    </a>
                                    <a href="{{ asset('storage/'.$acteMariage->certificat_residence_epoux) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-home"></i> Certificat résidence
                                    </a>
                                    <a href="{{ asset('storage/'.$acteMariage->copie_cni_epoux) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-id-card"></i> CNI
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Épouse -->
                    <div class="col-md-6">
                        <h4 class="text-primary mb-4 border-bottom pb-2">
                            <i class="fas fa-user me-2"></i>Informations de l'Épouse
                        </h4>
                        <div class="ps-3">
                            <p><strong>Nom complet:</strong> {{ $acteMariage->nom_epouse }} {{ $acteMariage->prenom_epouse }}</p>
                            <p><strong>Date de naissance:</strong> {{ $acteMariage->date_naissance_epouse ? \Carbon\Carbon::parse($acteMariage->date_naissance_epouse)->format('d/m/Y') : '' }}</p>
                            <p><strong>Lieu de naissance:</strong> {{ $acteMariage->lieu_naissance_epouse }}</p>
                            <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_epouse }}</p>
                            <p><strong>Profession:</strong> {{ $acteMariage->profession_epouse }}</p>
                            <p><strong>Domicile:</strong> {{ $acteMariage->domicile_epouse }}</p>
                            
                            <!-- Documents épouse -->
                            <div class="mt-3">
                                <h5 class="text-primary"><i class="fas fa-file-alt me-2"></i>Documents</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ asset('storage/'.$acteMariage->extrait_naissance_epouse) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-pdf"></i> Extrait naissance
                                    </a>
                                    <a href="{{ asset('storage/'.$acteMariage->photo_epouse) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-image"></i> Photo
                                    </a>
                                    <a href="{{ asset('storage/'.$acteMariage->certificat_residence_epouse) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-home"></i> Certificat résidence
                                    </a>
                                    <a href="{{ asset('storage/'.$acteMariage->copie_cni_epouse) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-id-card"></i> CNI
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations mariage -->
                <div class="row mt-4 pt-3 border-top">
                    <div class="col-md-6">
                        <h4 class="text-primary mb-3">
                            <i class="fas fa-heart me-2"></i>Informations du Mariage
                        </h4>
                        <div class="ps-3">
                            <p><strong>Date du mariage:</strong> {{ $acteMariage->date_mariage ? \Carbon\Carbon::parse($acteMariage->date_mariage)->format('d/m/Y') : '' }}</p>
                            <p><strong>Lieu du mariage:</strong> {{ $acteMariage->lieu_mariage }}</p>
                            <p><strong>Localité:</strong> {{ $acteMariage->localite->nom }}</p>
                            <p><strong>Numéro d'acte:</strong> {{ $acteMariage->numero_acte }}</p>
                            <p><strong>Statut:</strong> 
                                <span class="badge bg-{{ $acteMariage->statut === 'succès' ? 'success' : ($acteMariage->statut === 'échec' ? 'danger' : 'warning') }}">
                                    {{ $acteMariage->statut }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Témoins -->
                    <div class="col-md-6">
                        <h4 class="text-primary mb-3">
                            <i class="fas fa-users me-2"></i>Témoins
                        </h4>
                        <div class="row ps-3">
                            <div class="col-md-6">
                                <h5>Témoin 1</h5>
                                <p><strong>Nom:</strong> {{ $acteMariage->nom_temoin1 }}</p>
                                <p><strong>Prénom:</strong> {{ $acteMariage->prenom_temoin1 }}</p>
                                <p><strong>CNI:</strong> {{ $acteMariage->numero_cni_temoin1 }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Témoin 2</h5>
                                <p><strong>Nom:</strong> {{ $acteMariage->nom_temoin2 }}</p>
                                <p><strong>Prénom:</strong> {{ $acteMariage->prenom_temoin2 }}</p>
                                <p><strong>CNI:</strong> {{ $acteMariage->numero_cni_temoin2 }}</p>
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
                    <a href="{{ route('demandes.acte-mariage.create') }}" class="btn btn-secondary me-2">
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