<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'Acte de Naissance</title>
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
            <h1 class="h2 text-white">Détails de l'Acte de Naissance</h1>
            <p class="text-white-50 mb-0">Référence: {{ $acte->numero_acte }}</p>
        </div>

        <!-- Détails de l'acte -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-certificate me-2"></i>Certificat d'Acte de Naissance
                    </h3>
                    <span class="badge bg-light text-dark fs-6">
                        <i class="fas fa-copy me-1"></i> {{ $nombre_copie }} copie(s)
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Enfant -->
                    <div class="col-md-6 border-end">
                        <h4 class="text-primary mb-4 border-bottom pb-2">
                            <i class="fas fa-baby me-2"></i>Informations de l'Enfant
                        </h4>
                        <div class="ps-3">
                            <p><strong>Nom complet:</strong> {{ $acte->nom_enfant }} {{ $acte->prenom_enfant }}</p>
                            <p><strong>Date de naissance:</strong> {{ $acte->date_naissance->format('d/m/Y') }}</p>
                            <p><strong>Lieu de naissance:</strong> {{ $acte->lieu_naissance }}</p>
                            <p><strong>Date d'enregistrement:</strong> {{ $acte->date_acte->format('d/m/Y') }}</p>
                            <p><strong>Numéro d'acte:</strong> {{ $acte->numero_acte }}</p>
                        </div>
                    </div>

                    <!-- Parents -->
                    <div class="col-md-6">
                        <h4 class="text-primary mb-4 border-bottom pb-2">
                            <i class="fas fa-users me-2"></i>Informations des Parents
                        </h4>
                        <div class="ps-3">
                            <div class="mb-3">
                                <h5><i class="fas fa-male me-2"></i>Père</h5>
                                <p><strong>Nom:</strong> {{ $acte->nom_pere }} {{ $acte->prenom_pere }}</p>
                                <p><strong>Profession:</strong> {{ $acte->profession_pere ?? 'Non renseignée' }}</p>
                                <p><strong>Domicile:</strong> {{ $acte->domicile_pere ?? 'Non renseigné' }}</p>
                            </div>
                            <div class="mt-4">
                                <h5><i class="fas fa-female me-2"></i>Mère</h5>
                                <p><strong>Nom:</strong> {{ $acte->nom_mere }} {{ $acte->prenom_mere }}</p>
                                <p><strong>Profession:</strong> {{ $acte->profession_mere ?? 'Non renseignée' }}</p>
                                <p><strong>Domicile:</strong> {{ $acte->domicile_mere ?? 'Non renseigné' }}</p>
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
                    <a href="{{ route('demandes.acte-naissance.create') }}" class="btn btn-secondary me-2">
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
