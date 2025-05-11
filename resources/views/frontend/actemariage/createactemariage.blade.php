@extends('layouts.appactenaissance')
@section('content')
<!-- =======================
Main hero START -->
<section class="pt-8">
	<div class="container">
		<!-- Breadcrumb & title -->
		<div class="bg-dark rounded-4 text-center position-relative overflow-hidden py-5">

			<!-- Svg decoration -->
			<figure class="position-absolute top-0 start-0 ms-n8">
				<svg width="424" height="405" viewBox="0 0 424 405" fill="none" xmlns="http://www.w3.org/2000/svg">
					<ellipse cx="212" cy="202.5" rx="212" ry="202.5" fill="url(#paint0_linear_153_3831)"/>
					<defs>
					<linearGradient id="paint0_linear_153_3831" x1="212" y1="0" x2="212" y2="405" gradientUnits="userSpaceOnUse">
					<stop offset="0.0569271" stop-color="#D9D9D9" stop-opacity="0"/>
					<stop offset="0.998202" stop-color="#D9D9D9" stop-opacity="0.5"/>
					</linearGradient>
					</defs>
				</svg>
			</figure>

			<!-- SVG decoration -->
			<figure class="position-absolute top-0 end-0 me-n8 mt-5">
				<svg class="opacity-3" width="371" height="354" viewBox="0 0 371 354" fill="none" xmlns="http://www.w3.org/2000/svg">
					<ellipse cx="172.5" cy="176.5" rx="131.5" ry="125.5" fill="url(#paint0_linear_195_2)"/>
					<ellipse cx="185.5" cy="177" rx="185.5" ry="177" fill="url(#paint1_linear_195_2)"/>
					<defs>
					<linearGradient id="paint0_linear_195_2" x1="172.5" y1="51" x2="172.5" y2="302" gradientUnits="userSpaceOnUse">
					<stop offset="0.0569271" stop-color="#D9D9D9" stop-opacity="0.5"/>
					<stop offset="0.998202" stop-color="#D9D9D9" stop-opacity="0"/>
					</linearGradient>
					<linearGradient id="paint1_linear_195_2" x1="185.5" y1="0" x2="185.5" y2="354" gradientUnits="userSpaceOnUse">
					<stop offset="0.0569271" stop-color="#D9D9D9" stop-opacity="0.2"/>
					<stop offset="0.998202" stop-color="#D9D9D9" stop-opacity="0"/>
					</linearGradient>
					</defs>
				</svg>
			</figure>

			<!-- Breadcrumb -->
			<div class="d-flex justify-content-center position-relative z-index-9">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Acte de décès</li>
					</ol>
				</nav>
			</div>
			<!-- Title -->
			<h1 class="h2 text-white">Crée Un Acte De Mariage</h1>
		</div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('createactemariage.store') }}" id="acteMariageForm" enctype="multipart/form-data">
                                @csrf
        
                                <!-- Informations sur l'époux -->
                                <h4 class="mb-3">Informations sur l'époux</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nom_epoux" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_epoux') is-invalid @enderror" 
                                            id="nom_epoux" name="nom_epoux" value="{{ old('nom_epoux') }}" required>
                                        @error('nom_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_epoux" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_epoux') is-invalid @enderror" 
                                            id="prenom_epoux" name="prenom_epoux" value="{{ old('prenom_epoux') }}" required>
                                        @error('prenom_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date_naissance_epoux" class="form-label">Date de naissance *</label>
                                        <input type="date" class="form-control @error('date_naissance_epoux') is-invalid @enderror" 
                                            id="date_naissance_epoux" name="date_naissance_epoux" value="{{ old('date_naissance_epoux') }}" required>
                                        @error('date_naissance_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="lieu_naissance_epoux" class="form-label">Lieu de naissance *</label>
                                        <input type="text" class="form-control @error('lieu_naissance_epoux') is-invalid @enderror" 
                                            id="lieu_naissance_epoux" name="lieu_naissance_epoux" value="{{ old('lieu_naissance_epoux') }}" required>
                                        @error('lieu_naissance_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="numero_cni_epoux" class="form-label">Numéro CNI *</label>
                                        <input type="text" class="form-control @error('numero_cni_epoux') is-invalid @enderror" 
                                            id="numero_cni_epoux" name="numero_cni_epoux" value="{{ old('numero_cni_epoux') }}" required>
                                        @error('numero_cni_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="profession_epoux" class="form-label">Profession *</label>
                                        <input type="text" class="form-control @error('profession_epoux') is-invalid @enderror" 
                                            id="profession_epoux" name="profession_epoux" value="{{ old('profession_epoux') }}" required>
                                        @error('profession_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="domicile_epoux" class="form-label">Adresse complète *</label>
                                        <input type="text" class="form-control @error('domicile_epoux') is-invalid @enderror" 
                                            id="domicile_epoux" name="domicile_epoux" value="{{ old('domicile_epoux') }}" required>
                                        @error('domicile_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Informations sur l'épouse -->
                                <h4 class="mb-3 mt-5">Informations sur l'épouse</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nom_epouse" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom_epouse') is-invalid @enderror" 
                                            id="nom_epouse" name="nom_epouse" value="{{ old('nom_epouse') }}" required>
                                        @error('nom_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_epouse" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom_epouse') is-invalid @enderror" 
                                            id="prenom_epouse" name="prenom_epouse" value="{{ old('prenom_epouse') }}" required>
                                        @error('prenom_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date_naissance_epouse" class="form-label">Date de naissance *</label>
                                        <input type="date" class="form-control @error('date_naissance_epouse') is-invalid @enderror" 
                                            id="date_naissance_epouse" name="date_naissance_epouse" value="{{ old('date_naissance_epouse') }}" required>
                                        @error('date_naissance_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="lieu_naissance_epouse" class="form-label">Lieu de naissance *</label>
                                        <input type="text" class="form-control @error('lieu_naissance_epouse') is-invalid @enderror" 
                                            id="lieu_naissance_epouse" name="lieu_naissance_epouse" value="{{ old('lieu_naissance_epouse') }}" required>
                                        @error('lieu_naissance_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="numero_cni_epouse" class="form-label">Numéro CNI *</label>
                                        <input type="text" class="form-control @error('numero_cni_epouse') is-invalid @enderror" 
                                            id="numero_cni_epouse" name="numero_cni_epouse" value="{{ old('numero_cni_epouse') }}" required>
                                        @error('numero_cni_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="profession_epouse" class="form-label">Profession *</label>
                                        <input type="text" class="form-control @error('profession_epouse') is-invalid @enderror" 
                                            id="profession_epouse" name="profession_epouse" value="{{ old('profession_epouse') }}" required>
                                        @error('profession_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="domicile_epouse" class="form-label">Adresse complète *</label>
                                        <input type="text" class="form-control @error('domicile_epouse') is-invalid @enderror" 
                                            id="domicile_epouse" name="domicile_epouse" value="{{ old('domicile_epouse') }}" required>
                                        @error('domicile_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Informations sur le mariage -->
                                <h4 class="mb-3 mt-5">Informations sur le mariage</h4>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="date_mariage" class="form-label">Date du mariage *</label>
                                        <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" 
                                            id="date_mariage" name="date_mariage" value="{{ old('date_mariage') }}" required>
                                        @error('date_mariage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lieu_mariage" class="form-label">Lieu du mariage *</label>
                                        <input type="text" class="form-control @error('lieu_mariage') is-invalid @enderror" 
                                            id="lieu_mariage" name="lieu_mariage" value="{{ old('lieu_mariage') }}" required>
                                        @error('lieu_mariage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Localité -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type_localite" class="form-label">Type de localité *</label>
                                        <select class="form-select @error('type_localite') is-invalid @enderror" 
                                                id="type_localite" name="type_localite" required>
                                            <option value="" disabled selected>Choisir...</option>
                                            @foreach($typesLocalites as $type)
                                                <option value="{{ $type->id }}" {{ old('type_localite') == $type->id ? 'selected' : '' }}>
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
                                    <div class="col-md-6">
                                        <label for="localite_id" class="form-label">Localité *</label>
                                        <select class="form-select @error('localite_id') is-invalid @enderror" 
                                                id="localite_id" name="localite_id" required>
                                            <option value="" disabled selected>Choisir d'abord le type</option>
                                        </select>
                                        @error('localite_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Témoins -->
                                <h4 class="mb-3 mt-5">Informations sur les témoins</h4>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5>Témoin 1</h5>
                                        <div class="mb-3">
                                            <label for="nom_temoin1" class="form-label">Nom *</label>
                                            <input type="text" class="form-control @error('nom_temoin1') is-invalid @enderror" 
                                                id="nom_temoin1" name="nom_temoin1" value="{{ old('nom_temoin1') }}" required>
                                            @error('nom_temoin1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom_temoin1" class="form-label">Prénom *</label>
                                            <input type="text" class="form-control @error('prenom_temoin1') is-invalid @enderror" 
                                                id="prenom_temoin1" name="prenom_temoin1" value="{{ old('prenom_temoin1') }}" required>
                                            @error('prenom_temoin1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="numero_cni_temoin1" class="form-label">Numéro CNI *</label>
                                            <input type="text" class="form-control @error('numero_cni_temoin1') is-invalid @enderror" 
                                                id="numero_cni_temoin1" name="numero_cni_temoin1" value="{{ old('numero_cni_temoin1') }}" required>
                                            @error('numero_cni_temoin1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Témoin 2</h5>
                                        <div class="mb-3">
                                            <label for="nom_temoin2" class="form-label">Nom *</label>
                                            <input type="text" class="form-control @error('nom_temoin2') is-invalid @enderror" 
                                                id="nom_temoin2" name="nom_temoin2" value="{{ old('nom_temoin2') }}" required>
                                            @error('nom_temoin2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom_temoin2" class="form-label">Prénom *</label>
                                            <input type="text" class="form-control @error('prenom_temoin2') is-invalid @enderror" 
                                                id="prenom_temoin2" name="prenom_temoin2" value="{{ old('prenom_temoin2') }}" required>
                                            @error('prenom_temoin2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="numero_cni_temoin2" class="form-label">Numéro CNI *</label>
                                            <input type="text" class="form-control @error('numero_cni_temoin2') is-invalid @enderror" 
                                                id="numero_cni_temoin2" name="numero_cni_temoin2" value="{{ old('numero_cni_temoin2') }}" required>
                                            @error('numero_cni_temoin2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Documents -->
                                <h4 class="mb-3 mt-5">Documents requis</h4>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="extrait_naissance_epoux" class="form-label">Extrait de naissance époux *</label>
                                        <input type="file" class="form-control @error('extrait_naissance_epoux') is-invalid @enderror" 
                                            id="extrait_naissance_epoux" name="extrait_naissance_epoux" required>
                                        @error('extrait_naissance_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="text-muted">Document de moins de 3 mois</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extrait_naissance_epouse" class="form-label">Extrait de naissance épouse *</label>
                                        <input type="file" class="form-control @error('extrait_naissance_epouse') is-invalid @enderror" 
                                            id="extrait_naissance_epouse" name="extrait_naissance_epouse" required>
                                        @error('extrait_naissance_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="text-muted">Document de moins de 3 mois</small>
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="photo_epoux" class="form-label">Photo d'identité époux *</label>
                                        <input type="file" class="form-control @error('photo_epoux') is-invalid @enderror" 
                                            id="photo_epoux" name="photo_epoux" required>
                                        @error('photo_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="photo_epouse" class="form-label">Photo d'identité épouse *</label>
                                        <input type="file" class="form-control @error('photo_epouse') is-invalid @enderror" 
                                            id="photo_epouse" name="photo_epouse" required>
                                        @error('photo_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="certificat_residence_epoux" class="form-label">Certificat de résidence époux *</label>
                                        <input type="file" class="form-control @error('certificat_residence_epoux') is-invalid @enderror" 
                                            id="certificat_residence_epoux" name="certificat_residence_epoux" required>
                                        @error('certificat_residence_epoux')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="certificat_residence_epouse" class="form-label">Certificat de résidence épouse *</label>
                                        <input type="file" class="form-control @error('certificat_residence_epouse') is-invalid @enderror" 
                                            id="certificat_residence_epouse" name="certificat_residence_epouse" required>
                                        @error('certificat_residence_epouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
        
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Enregistrer l'acte de mariage
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chargement dynamique des localités (identique à votre script existant)
            const typeLocaliteSelect = document.getElementById('type_localite');
            const localiteSelect = document.getElementById('localite_id');
        
            typeLocaliteSelect.addEventListener('change', function() {
                const typeId = this.value;
                
                if (!typeId) {
                    localiteSelect.innerHTML = '<option value="" disabled selected>Choisir d\'abord le type</option>';
                    return;
                }
        
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
        
            // Pré-sélection si retour avec erreurs
            @if(old('type_localite'))
                const event = new Event('change');
                typeLocaliteSelect.value = "{{ old('type_localite') }}";
                typeLocaliteSelect.dispatchEvent(event);
                
                // On doit attendre que les localités soient chargées pour pré-sélectionner
                setTimeout(() => {
                    if (localiteSelect.querySelector(`option[value="{{ old('localite_id') }}"]`)) {
                        localiteSelect.value = "{{ old('localite_id') }}";
                    }
                }, 500);
            @endif
        });
        </script>

	</div>	
</section>
<!-- =======================
Main hero END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
@stop