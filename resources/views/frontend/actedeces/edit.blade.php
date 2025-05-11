<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'acte de décès</title>

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
                        <h4 class="mb-0">Modifier l'acte de décès</h4>
                        <a href="{{ route('actedeces.show', $acteDeces->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Annuler
                        </a>
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('actedeces.update', $acteDeces->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <!-- Informations sur le défunt -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur le défunt</h5>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nom_defunt" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" 
                                               id="nom_defunt" name="nom_defunt" value="{{ old('nom_defunt', $acteDeces->nom_defunt) }}" required>
                                        @error('nom_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prenom_defunt" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_defunt') is-invalid @enderror" 
                                               id="prenom_defunt" name="prenom_defunt" value="{{ old('prenom_defunt', $acteDeces->prenom_defunt) }}" required>
                                        @error('prenom_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_deces" class="form-label">Date de décès *</label>
                                        {{-- <input type="date" class="form-control @error('date_deces') is-invalid @enderror" 
                                               id="date_deces" name="date_deces" value="{{ old('date_deces', $acteDeces->date_deces->format('Y-m-d')) }}" required> --}}
                                               <input type="date" class="form-control @error('date_deces') is-invalid @enderror" 
       id="date_deces" name="date_deces" value="{{ old('date_deces', $acteDeces->date_deces ? \Carbon\Carbon::parse($acteDeces->date_deces)->format('Y-m-d') : '') }}" required>
                                        @error('date_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lieu_deces" class="form-label">Lieu de décès *</label>
                                        <input type="text" class="form-control @error('lieu_deces') is-invalid @enderror" 
                                               id="lieu_deces" name="lieu_deces" value="{{ old('lieu_deces', $acteDeces->lieu_deces) }}" required>
                                        @error('lieu_deces')
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
                                            <option value="enfant" {{ old('filiation', $acteDeces->filiation) == 'enfant' ? 'selected' : '' }}>Enfant</option>
                                            <option value="père" {{ old('filiation', $acteDeces->filiation) == 'père' ? 'selected' : '' }}>Père</option>
                                            <option value="mère" {{ old('filiation', $acteDeces->filiation) == 'mère' ? 'selected' : '' }}>Mère</option>
                                            <option value="frère" {{ old('filiation', $acteDeces->filiation) == 'frère' ? 'selected' : '' }}>Frère</option>
                                            <option value="soeur" {{ old('filiation', $acteDeces->filiation) == 'soeur' ? 'selected' : '' }}>Soeur</option>
                                            <option value="autre" {{ old('filiation', $acteDeces->filiation) == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('filiation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_naissance" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                               id="date_naissance" name="date_naissance" value="{{ old('date_naissance', optional($acteDeces->date_naissance)->format('Y-m-d')) }}">
                                        @error('date_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                               id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance', $acteDeces->lieu_naissance) }}">
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="cause_deces" class="form-label">Cause du décès</label>
                                        <textarea class="form-control @error('cause_deces') is-invalid @enderror" 
                                                  id="cause_deces" name="cause_deces">{{ old('cause_deces', $acteDeces->cause_deces) }}</textarea>
                                        @error('cause_deces')
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
                                        
                                        @if($acteDeces->documents)
                                            <div class="mt-3">
                                                <h6>Documents existants</h6>
                                                @foreach(json_decode($acteDeces->documents) as $index => $document)
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
    
                            <!-- Informations sur le déclarant -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur le déclarant</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_declarant" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_declarant') is-invalid @enderror" 
                                               id="nom_declarant" name="nom_declarant" value="{{ old('nom_declarant', $acteDeces->nom_declarant) }}" required>
                                        @error('nom_declarant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_declarant" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_declarant') is-invalid @enderror" 
                                               id="prenom_declarant" name="prenom_declarant" value="{{ old('prenom_declarant', $acteDeces->prenom_declarant) }}" required>
                                        @error('prenom_declarant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type_parent" class="form-label">Type de parenté</label>
                                        <input type="text" class="form-control @error('type_parent') is-invalid @enderror" 
                                               id="type_parent" name="type_parent" value="{{ old('type_parent', $acteDeces->type_parent) }}">
                                        @error('type_parent')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_parent" class="form-label">Nom du parent</label>
                                        <input type="text" class="form-control @error('nom_parent') is-invalid @enderror" 
                                               id="nom_parent" name="nom_parent" value="{{ old('nom_parent', $acteDeces->nom_parent) }}">
                                        @error('nom_parent')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_parent" class="form-label">Prénom du parent</label>
                                        <input type="text" class="form-control @error('prenom_parent') is-invalid @enderror" 
                                               id="prenom_parent" name="prenom_parent" value="{{ old('prenom_parent', $acteDeces->prenom_parent) }}">
                                        @error('prenom_parent')
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
                                               id="numero_acte" name="numero_acte" value="{{ old('numero_acte', $acteDeces->numero_acte) }}" required readonly>
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
                                        {{-- <input type="date" class="form-control @error('date_acte') is-invalid @enderror" 
                                               id="date_acte" name="date_acte" value="{{ old('date_acte', $acteDeces->date_acte->format('Y-m-d')) }}" required> --}}
                                               <input type="date" class="form-control @error('date_acte') is-invalid @enderror" 
       id="date_acte" name="date_acte" value="{{ old('date_acte', $acteDeces->date_acte ? \Carbon\Carbon::parse($acteDeces->date_acte)->format('Y-m-d') : '') }}" required>
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
                                            <option value="en cours" {{ old('statut', $acteDeces->statut) == 'en cours' ? 'selected' : '' }}>En attente</option>
                                            <option value="succès" {{ old('statut', $acteDeces->statut) == 'succès' ? 'selected' : '' }}>Validé</option>
                                            <option value="échec" {{ old('statut', $acteDeces->statut) == 'échec' ? 'selected' : '' }}>Rejeté</option>
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
                                                    {{ old('type_localite', $acteDeces->localite->type_localite_id) == $type->id ? 'selected' : '' }}>
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
                                                    {{ old('localite_id', $acteDeces->localite_id) == $localite->id ? 'selected' : '' }}>
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