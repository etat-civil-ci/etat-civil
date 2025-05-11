<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement de votre demande</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (pour les icônes) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<section class="pt-5">
    <div class="container">
        <!-- En-tête -->
        <div class="bg-dark rounded-4 text-center py-5 text-white mb-5">
            <h1 class="h2">Paiement de votre demande</h1>
        </div>

        <!-- Formulaire de paiement -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Effectuer votre paiement</h3>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('demandes.paiement.store') }}" method="POST" class="row g-3">
                    @csrf
                    <input type="hidden" name="demande_id" value="{{ $demande->id }}">

                    <div class="col-md-6">
                        <label for="pays" class="form-label">Pays *</label>
                        <select class="form-select @error('pays') is-invalid @enderror" id="pays" name="pays" required>
                            <option value="" selected disabled>Sélectionnez votre pays</option>
                            <option value="Bénin" {{ old('pays') == 'Bénin' ? 'selected' : '' }}>Bénin</option>
                            <option value="Côte d'Ivoire" {{ old('pays') == "Côte d'Ivoire" ? 'selected' : '' }}>Côte d'Ivoire</option>
                            <option value="Togo" {{ old('pays') == 'Togo' ? 'selected' : '' }}>Togo</option>
                        </select>
                        @error('pays')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="operateur" class="form-label">Opérateur *</label>
                        <select class="form-select @error('operateur') is-invalid @enderror" id="operateur" name="operateur" required>
                            <option value="" selected disabled>Sélectionnez votre opérateur</option>
                            <option value="MTN" {{ old('operateur') == 'MTN' ? 'selected' : '' }}>MTN</option>
                            <option value="MOOV" {{ old('operateur') == 'MOOV' ? 'selected' : '' }}>MOOV</option>
                            <option value="ORANGE" {{ old('operateur') == 'ORANGE' ? 'selected' : '' }}>ORANGE</option>
                        </select>
                        @error('operateur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="numero_telephone" class="form-label">Numéro de téléphone *</label>
                        <input type="text" class="form-control @error('numero_telephone') is-invalid @enderror" 
                               id="numero_telephone" name="numero_telephone" 
                               value="{{ old('numero_telephone') }}" required
                               placeholder="Ex: 97123456">
                        @error('numero_telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="montant" class="form-label">Montant à payer</label>
                        <div class="input-group">
                            <span class="input-group-text">FCFA</span>
                            <input type="text" class="form-control" id="montant" value="{{ $montant }}" readonly>
                            <input type="hidden" name="montant" value="{{ $montant }}">
                        </div>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <a href="{{ route('demande.actenaissance.details', ['acte' => $demande->acte_id, 'nombre_copie' => $demande->nombre_copie, 'demande_id' => $demande->id]) }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-money-bill-wave me-2"></i> Payer maintenant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
