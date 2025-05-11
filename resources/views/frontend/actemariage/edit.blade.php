<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'acte de mariage</title>

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
                        <h4 class="mb-0">Modifier l'acte de mariage</h4>
                        <a href="{{ route('actemariage.show', $acteMariage->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Annuler
                        </a>
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('actemariage.update', $acteMariage->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <!-- Informations sur l'époux -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur l'époux</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_epoux" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_epoux') is-invalid @enderror" 
                                               id="nom_epoux" name="nom_epoux" value="{{ old('nom_epoux', $acteMariage->nom_epoux) }}" required>
                                        @error('nom_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_epoux" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_epoux') is-invalid @enderror" 
                                               id="prenom_epoux" name="prenom_epoux" value="{{ old('prenom_epoux', $acteMariage->prenom_epoux) }}" required>
                                        @error('prenom_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_naissance_epoux" class="form-label">Date de naissance *</label>
                                        <input type="date" class="form-control @error('date_naissance_epoux') is-invalid @enderror" 
                                               id="date_naissance_epoux" name="date_naissance_epoux" 
                                               value="{{ old('date_naissance_epoux', $acteMariage->date_naissance_epoux ? \Carbon\Carbon::parse($acteMariage->date_naissance_epoux)->format('Y-m-d') : '') }}" required>
                                        @error('date_naissance_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lieu_naissance_epoux" class="form-label">Lieu de naissance *</label>
                                        <input type="text" class="form-control @error('lieu_naissance_epoux') is-invalid @enderror" 
                                               id="lieu_naissance_epoux" name="lieu_naissance_epoux" value="{{ old('lieu_naissance_epoux', $acteMariage->lieu_naissance_epoux) }}" required>
                                        @error('lieu_naissance_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="numero_cni_epoux" class="form-label">Numéro CNI *</label>
                                        <input type="text" class="form-control @error('numero_cni_epoux') is-invalid @enderror" 
                                               id="numero_cni_epoux" name="numero_cni_epoux" value="{{ old('numero_cni_epoux', $acteMariage->numero_cni_epoux) }}" required>
                                        @error('numero_cni_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="domicile_epoux" class="form-label">Domicile *</label>
                                        <input type="text" class="form-control @error('domicile_epoux') is-invalid @enderror" 
                                               id="domicile_epoux" name="domicile_epoux" value="{{ old('domicile_epoux', $acteMariage->domicile_epoux) }}" required>
                                        @error('domicile_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profession_epoux" class="form-label">Profession *</label>
                                        <input type="text" class="form-control @error('profession_epoux') is-invalid @enderror" 
                                               id="profession_epoux" name="profession_epoux" value="{{ old('profession_epoux', $acteMariage->profession_epoux) }}" required>
                                        @error('profession_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Documents époux -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Documents de l'époux</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="extrait_naissance_epoux" class="form-label">Extrait de naissance</label>
                                                <input type="file" class="form-control @error('extrait_naissance_epoux') is-invalid @enderror" 
                                                       id="extrait_naissance_epoux" name="extrait_naissance_epoux">
                                                @if($acteMariage->extrait_naissance_epoux)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->extrait_naissance_epoux) }}" target="_blank">Voir le document actuel</a>
                                                    </small>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="photo_epoux" class="form-label">Photo</label>
                                                <input type="file" class="form-control @error('photo_epoux') is-invalid @enderror" 
                                                       id="photo_epoux" name="photo_epoux" accept="image/*">
                                                @if($acteMariage->photo_epoux)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->photo_epoux) }}" target="_blank">Voir la photo actuelle</a>
                                                    </small>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="copie_cni_epoux" class="form-label">Copie CNI</label>
                                                <input type="file" class="form-control @error('copie_cni_epoux') is-invalid @enderror" 
                                                       id="copie_cni_epoux" name="copie_cni_epoux">
                                                @if($acteMariage->copie_cni_epoux)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->copie_cni_epoux) }}" target="_blank">Voir le document actuel</a>
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Informations sur l'épouse -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur l'épouse</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_epouse" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_epouse') is-invalid @enderror" 
                                               id="nom_epouse" name="nom_epouse" value="{{ old('nom_epouse', $acteMariage->nom_epouse) }}" required>
                                        @error('nom_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_epouse" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_epouse') is-invalid @enderror" 
                                               id="prenom_epouse" name="prenom_epouse" value="{{ old('prenom_epouse', $acteMariage->prenom_epouse) }}" required>
                                        @error('prenom_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_naissance_epouse" class="form-label">Date de naissance *</label>
                                        <input type="date" class="form-control @error('date_naissance_epouse') is-invalid @enderror" 
                                               id="date_naissance_epouse" name="date_naissance_epouse" 
                                               value="{{ old('date_naissance_epouse', $acteMariage->date_naissance_epouse ? \Carbon\Carbon::parse($acteMariage->date_naissance_epouse)->format('Y-m-d') : '') }}" required>
                                        @error('date_naissance_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lieu_naissance_epouse" class="form-label">Lieu de naissance *</label>
                                        <input type="text" class="form-control @error('lieu_naissance_epouse') is-invalid @enderror" 
                                               id="lieu_naissance_epouse" name="lieu_naissance_epouse" value="{{ old('lieu_naissance_epouse', $acteMariage->lieu_naissance_epouse) }}" required>
                                        @error('lieu_naissance_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="numero_cni_epouse" class="form-label">Numéro CNI *</label>
                                        <input type="text" class="form-control @error('numero_cni_epouse') is-invalid @enderror" 
                                               id="numero_cni_epouse" name="numero_cni_epouse" value="{{ old('numero_cni_epouse', $acteMariage->numero_cni_epouse) }}" required>
                                        @error('numero_cni_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="domicile_epouse" class="form-label">Domicile *</label>
                                        <input type="text" class="form-control @error('domicile_epouse') is-invalid @enderror" 
                                               id="domicile_epouse" name="domicile_epouse" value="{{ old('domicile_epouse', $acteMariage->domicile_epouse) }}" required>
                                        @error('domicile_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profession_epouse" class="form-label">Profession *</label>
                                        <input type="text" class="form-control @error('profession_epouse') is-invalid @enderror" 
                                               id="profession_epouse" name="profession_epouse" value="{{ old('profession_epouse', $acteMariage->profession_epouse) }}" required>
                                        @error('profession_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Documents épouse -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Documents de l'épouse</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="extrait_naissance_epouse" class="form-label">Extrait de naissance</label>
                                                <input type="file" class="form-control @error('extrait_naissance_epouse') is-invalid @enderror" 
                                                       id="extrait_naissance_epouse" name="extrait_naissance_epouse">
                                                @if($acteMariage->extrait_naissance_epouse)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->extrait_naissance_epouse) }}" target="_blank">Voir le document actuel</a>
                                                    </small>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="photo_epouse" class="form-label">Photo</label>
                                                <input type="file" class="form-control @error('photo_epouse') is-invalid @enderror" 
                                                       id="photo_epouse" name="photo_epouse" accept="image/*">
                                                @if($acteMariage->photo_epouse)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->photo_epouse) }}" target="_blank">Voir la photo actuelle</a>
                                                    </small>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label for="copie_cni_epouse" class="form-label">Copie CNI</label>
                                                <input type="file" class="form-control @error('copie_cni_epouse') is-invalid @enderror" 
                                                       id="copie_cni_epouse" name="copie_cni_epouse">
                                                @if($acteMariage->copie_cni_epouse)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->copie_cni_epouse) }}" target="_blank">Voir le document actuel</a>
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Informations sur le mariage -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations sur le mariage</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_mariage" class="form-label">Date du mariage *</label>
                                        <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" 
                                               id="date_mariage" name="date_mariage" 
                                               value="{{ old('date_mariage', $acteMariage->date_mariage ? \Carbon\Carbon::parse($acteMariage->date_mariage)->format('Y-m-d') : '') }}" required>
                                        @error('date_mariage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lieu_mariage" class="form-label">Lieu du mariage *</label>
                                        <input type="text" class="form-control @error('lieu_mariage') is-invalid @enderror" 
                                               id="lieu_mariage" name="lieu_mariage" value="{{ old('lieu_mariage', $acteMariage->lieu_mariage) }}" required>
                                        @error('lieu_mariage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Témoins -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_temoin1" class="form-label">Nom du témoin 1 *</label>
                                        <input type="text" class="form-control @error('nom_temoin1') is-invalid @enderror" 
                                               id="nom_temoin1" name="nom_temoin1" value="{{ old('nom_temoin1', $acteMariage->nom_temoin1) }}" required>
                                        @error('nom_temoin1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_temoin1" class="form-label">Prénom du témoin 1 *</label>
                                        <input type="text" class="form-control @error('prenom_temoin1') is-invalid @enderror" 
                                               id="prenom_temoin1" name="prenom_temoin1" value="{{ old('prenom_temoin1', $acteMariage->prenom_temoin1) }}" required>
                                        @error('prenom_temoin1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numero_cni_temoin1" class="form-label">CNI du témoin 1 *</label>
                                        <input type="text" class="form-control @error('numero_cni_temoin1') is-invalid @enderror" 
                                               id="numero_cni_temoin1" name="numero_cni_temoin1" value="{{ old('numero_cni_temoin1', $acteMariage->numero_cni_temoin1) }}" required>
                                        @error('numero_cni_temoin1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom_temoin2" class="form-label">Nom du témoin 2 *</label>
                                        <input type="text" class="form-control @error('nom_temoin2') is-invalid @enderror" 
                                               id="nom_temoin2" name="nom_temoin2" value="{{ old('nom_temoin2', $acteMariage->nom_temoin2) }}" required>
                                        @error('nom_temoin2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom_temoin2" class="form-label">Prénom du témoin 2 *</label>
                                        <input type="text" class="form-control @error('prenom_temoin2') is-invalid @enderror" 
                                               id="prenom_temoin2" name="prenom_temoin2" value="{{ old('prenom_temoin2', $acteMariage->prenom_temoin2) }}" required>
                                        @error('prenom_temoin2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numero_cni_temoin2" class="form-label">CNI du témoin 2 *</label>
                                        <input type="text" class="form-control @error('numero_cni_temoin2') is-invalid @enderror" 
                                               id="numero_cni_temoin2" name="numero_cni_temoin2" value="{{ old('numero_cni_temoin2', $acteMariage->numero_cni_temoin2) }}" required>
                                        @error('numero_cni_temoin2')
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
                                               id="numero_acte" name="numero_acte" value="{{ old('numero_acte', $acteMariage->numero_acte) }}" required readonly>
                                        @error('numero_acte')
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
                                            <option value="en cours" {{ old('statut', $acteMariage->statut) == 'en cours' ? 'selected' : '' }}>En attente</option>
                                            <option value="succès" {{ old('statut', $acteMariage->statut) == 'succès' ? 'selected' : '' }}>Validé</option>
                                            <option value="échec" {{ old('statut', $acteMariage->statut) == 'échec' ? 'selected' : '' }}>Rejeté</option>
                                        </select>
                                        @error('statut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="type_localite" class="form-label">Type de localité *</label>
                                        <select class="form-select @error('type_localite') is-invalid @enderror" 
                                                id="type_localite" name="type_localite" required>
                                            <option value="" disabled>Choisir...</option>
                                            @foreach($typesLocalites as $type)
                                                <option value="{{ $type->id }}" 
                                                    {{ old('type_localite', $acteMariage->localite->type_localite_id) == $type->id ? 'selected' : '' }}>
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
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="localite_id" class="form-label">Localité *</label>
                                        <select class="form-select @error('localite_id') is-invalid @enderror" 
                                                id="localite_id" name="localite_id" required>
                                            <option value="" disabled>Choisir...</option>
                                            @foreach($localites as $localite)
                                                <option value="{{ $localite->id }}" 
                                                    {{ old('localite_id', $acteMariage->localite_id) == $localite->id ? 'selected' : '' }}>
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
                                
                                <!-- Autres documents -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Autres documents</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="certificat_residence_epoux" class="form-label">Certificat de résidence (époux)</label>
                                                <input type="file" class="form-control @error('certificat_residence_epoux') is-invalid @enderror" 
                                                       id="certificat_residence_epoux" name="certificat_residence_epoux">
                                                @if($acteMariage->certificat_residence_epoux)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->certificat_residence_epoux) }}" target="_blank">Voir le document actuel</a>
                                                    </small>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="certificat_residence_epouse" class="form-label">Certificat de résidence (épouse)</label>
                                                <input type="file" class="form-control @error('certificat_residence_epouse') is-invalid @enderror" 
                                                       id="certificat_residence_epouse" name="certificat_residence_epouse">
                                                @if($acteMariage->certificat_residence_epouse)
                                                    <small class="text-muted">
                                                        <a href="{{ Storage::url($acteMariage->certificat_residence_epouse) }}" target="_blank">Voir le document actuel</a>
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
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