<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'acte de naissance</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (pour les icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Modifier l'acte de naissance</h4>
                        <a href="{{ route('actenaissance.show', $acteNaissance->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Annuler
                        </a>
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('actenaissance.update', $acteNaissance->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <!-- Informations sur l'enfant -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur l'enfant</h5>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nom_enfant" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_enfant') is-invalid @enderror" 
                                               id="nom_enfant" name="nom_enfant" value="{{ old('nom_enfant', $acteNaissance->nom_enfant) }}" required>
                                        @error('nom_enfant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prenom_enfant" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_enfant') is-invalid @enderror" 
                                               id="prenom_enfant" name="prenom_enfant" value="{{ old('prenom_enfant', $acteNaissance->prenom_enfant) }}" required>
                                        @error('prenom_enfant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_naissance" class="form-label">Date de naissance *</label>
                                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                               id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $acteNaissance->date_naissance->format('Y-m-d')) }}" required>
                                        @error('date_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lieu_naissance" class="form-label">Lieu de naissance *</label>
                                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                               id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance', $acteNaissance->lieu_naissance) }}" required>
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="filiation" class="form-label">Type de filiation *</label>
                                        <select class="form-select @error('filiation') is-invalid @enderror" id="filiation" name="filiation" required>
                                            <option value="moi" {{ old('filiation', $acteNaissance->filiation) == 'moi' ? 'selected' : '' }}>Moi-meme</option>
                                            <option value="père" {{ old('filiation', $acteNaissance->filiation) == 'père' ? 'selected' : '' }}>Père</option>
                                            <option value="mère" {{ old('filiation', $acteNaissance->filiation) == 'mère' ? 'selected' : '' }}>Mère</option>
                                            <option value="frère" {{ old('filiation', $acteNaissance->filiation) == 'frère' ? 'selected' : '' }}>Frère</option>
                                            <option value="soeur" {{ old('filiation', $acteNaissance->filiation) == 'soeur' ? 'selected' : '' }}>Soeur</option>
                                            <option value="autre" {{ old('filiation', $acteNaissance->filiation) == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('filiation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="new_documents" class="form-label">Ajouter des documents</label>
                                        <input type="file" class="form-control" id="new_documents" name="new_documents[]" multiple>
                                        <small class="text-muted">Format: PDF, JPG, PNG - max 2MB chacun</small>
                                        
                                        @if($acteNaissance->documents)
                                            <div class="mt-3">
                                                <h6>Documents existants</h6>
                                                @foreach(json_decode($acteNaissance->documents) as $index => $document)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="delete_doc_{{ $index }}" name="delete_documents[]" 
                                                           value="{{ $index }}">
                                                    <label class="form-check-label" for="delete_doc_{{ $index }}">
                                                        <a href="{{ Storage::url($document) }}" target="_blank">
                                                            Document {{ $loop->iteration }} ({{ basename($document) }})
                                                        </a>
                                                    </label>
                                                </div>
                                                @endforeach
                                                <small>Cochez les documents à supprimer</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
    
                            <!-- Informations sur les parents -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur les parents</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6>Père</h6>
                                    <div class="mb-3">
                                        <label for="nom_pere" class="form-label">Nom</label>
                                        <input type="text" class="form-control @error('nom_pere') is-invalid @enderror" 
                                               id="nom_pere" name="nom_pere" value="{{ old('nom_pere', $acteNaissance->nom_pere) }}">
                                        @error('nom_pere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="prenom_pere" class="form-label">Prénom</label>
                                        <input type="text" class="form-control @error('prenom_pere') is-invalid @enderror" 
                                               id="prenom_pere" name="prenom_pere" value="{{ old('prenom_pere', $acteNaissance->prenom_pere) }}">
                                        @error('prenom_pere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="domicile_pere" class="form-label">Domicile</label>
                                        <input type="text" class="form-control @error('domicile_pere') is-invalid @enderror" 
                                               id="domicile_pere" name="domicile_pere" value="{{ old('domicile_pere', $acteNaissance->domicile_pere) }}">
                                        @error('domicile_pere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="profession_pere" class="form-label">Profession</label>
                                        <input type="text" class="form-control @error('profession_pere') is-invalid @enderror" 
                                               id="profession_pere" name="profession_pere" value="{{ old('profession_pere', $acteNaissance->profession_pere) }}">
                                        @error('profession_pere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="numero_cni_pere" class="form-label">Numéro CNI du père</label>
                                        <input type="text" class="form-control @error('numero_cni_pere') is-invalid @enderror" 
                                               id="numero_cni_pere" name="numero_cni_pere" 
                                               value="{{ old('numero_cni_pere', $acteNaissance->numero_cni_pere) }}">
                                        @error('numero_cni_pere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6>Mère *</h6>
                                    <div class="mb-3">
                                        <label for="nom_mere" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_mere') is-invalid @enderror" 
                                               id="nom_mere" name="nom_mere" value="{{ old('nom_mere', $acteNaissance->nom_mere) }}" required>
                                        @error('nom_mere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="prenom_mere" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_mere') is-invalid @enderror" 
                                               id="prenom_mere" name="prenom_mere" value="{{ old('prenom_mere', $acteNaissance->prenom_mere) }}" required>
                                        @error('prenom_mere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="domicile_mere" class="form-label">Domicile</label>
                                        <input type="text" class="form-control @error('domicile_mere') is-invalid @enderror" 
                                               id="domicile_mere" name="domicile_mere" value="{{ old('domicile_mere', $acteNaissance->domicile_mere) }}">
                                        @error('domicile_mere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="profession_mere" class="form-label">Profession</label>
                                        <input type="text" class="form-control @error('profession_mere') is-invalid @enderror" 
                                               id="profession_mere" name="profession_mere" value="{{ old('profession_mere', $acteNaissance->profession_mere) }}">
                                        @error('profession_mere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="numero_cni_mere" class="form-label">Numéro CNI de la mère</label>
                                        <input type="text" class="form-control @error('numero_cni_mere') is-invalid @enderror" 
                                               id="numero_cni_mere" name="numero_cni_mere" 
                                               value="{{ old('numero_cni_mere', $acteNaissance->numero_cni_mere) }}">
                                        @error('numero_cni_mere')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <!-- Informations administratives -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations administratives</h5>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="numero_acte" class="form-label">Numéro d'acte *</label>
                                        <input type="text" class="form-control @error('numero_acte') is-invalid @enderror" 
                                               id="numero_acte" name="numero_acte" value="{{ old('numero_acte', $acteNaissance->numero_acte) }}" required readonly>
                                        @error('numero_acte')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_acte" class="form-label">Date de l'acte *</label>
                                        <input type="date" class="form-control @error('date_acte') is-invalid @enderror" 
                                               id="date_acte" name="date_acte" value="{{ old('date_acte', $acteNaissance->date_acte->format('Y-m-d')) }}" required>
                                        @error('date_acte')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="statut" class="form-label">Statut *</label>
                                        <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                            <option value="en cours" {{ old('statut', $acteNaissance->statut) == 'en cours' ? 'selected' : '' }}>En attente</option>
                                            <option value="succès" {{ old('statut', $acteNaissance->statut) == 'succès' ? 'selected' : '' }}>Validé</option>
                                            <option value="échec" {{ old('statut', $acteNaissance->statut) == 'échec' ? 'selected' : '' }}>Rejeté</option>
                                        </select>
                                        @error('statut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type_localite" class="form-label">Type de localité *</label>
                                        <select class="form-select @error('type_localite') is-invalid @enderror" 
                                                id="type_localite" name="type_localite" required>
                                            <option value="" disabled>Choisir...</option>
                                            @foreach($typesLocalites as $type)
                                                <option value="{{ $type->id }}" 
                                                    {{ old('type_localite', $acteNaissance->localite->type_localite_id) == $type->id ? 'selected' : '' }}>
                                                    {{ $type->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type_localite')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="localite_id" class="form-label">Localité *</label>
                                        <select class="form-select @error('localite_id') is-invalid @enderror" 
                                                id="localite_id" name="localite_id" required>
                                            <option value="" disabled>Choisir...</option>
                                            @foreach($localites as $localite)
                                                <option value="{{ $localite->id }}" 
                                                    {{ old('localite_id', $acteNaissance->localite_id) == $localite->id ? 'selected' : '' }}>
                                                    {{ $localite->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('localite_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <!-- Informations sur le demandeur -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur le demandeur</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_demandeur" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_demandeur') is-invalid @enderror" 
                                               id="nom_demandeur" name="nom_demandeur" value="{{ old('nom_demandeur', $acteNaissance->nom_demandeur) }}" required>
                                        @error('nom_demandeur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_demandeur" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_demandeur') is-invalid @enderror" 
                                               id="prenom_demandeur" name="prenom_demandeur" value="{{ old('prenom_demandeur', $acteNaissance->prenom_demandeur) }}" required>
                                        @error('prenom_demandeur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeLocaliteSelect = document.getElementById('type_localite');
            const localiteSelect = document.getElementById('localite_id');
        
            if (typeLocaliteSelect && localiteSelect) {
                typeLocaliteSelect.addEventListener('change', function() {
                    const typeId = this.value;
                    localiteSelect.innerHTML = '<option value="" disabled selected>Chargement...</option>';
                    
                    if (!typeId) return;
        
                    fetch(`/api/localites/${typeId}`)
                        .then(response => response.json())
                        .then(data => {
                            localiteSelect.innerHTML = '';
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.disabled = true;
                            defaultOption.selected = true;
                            defaultOption.textContent = 'Choisir...';
                            localiteSelect.appendChild(defaultOption);
        
                            data.forEach(localite => {
                                const option = document.createElement('option');
                                option.value = localite.id;
                                option.textContent = localite.nom;
                                localiteSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            localiteSelect.innerHTML = '<option value="" disabled selected>Erreur de chargement</option>';
                        });
                });
        
                // Déclencher le changement si retour avec erreurs
                @if(old('type_localite'))
                    typeLocaliteSelect.value = "{{ old('type_localite') }}";
                    typeLocaliteSelect.dispatchEvent(new Event('change'));
                    
                    // On doit attendre que les localités soient chargées pour pré-sélectionner
                    setTimeout(() => {
                        if (localiteSelect.querySelector(`option[value="{{ old('localite_id') }}"]`)) {
                            localiteSelect.value = "{{ old('localite_id') }}";
                        }
                    }, 500);
                @endif
            }
        });
        </script>
</body>
</html>


<!-- Script pour le chargement dynamique des localités -->
