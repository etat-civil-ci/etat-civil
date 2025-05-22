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
			<h1 class="h2 text-white">Crée Un Acte De Décès</h1>
		</div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('createactedeces.store') }}" id="acteDecesForm" enctype="multipart/form-data">
                                @csrf

                                <!-- Informations sur le déclarant -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nom_declarant" class="form-label">Nom du déclarant <span style="color:red">*</label>
                                        <input type="text" class="form-control @error('nom_declarant') is-invalid @enderror" 
                                            id="nom_declarant" name="nom_declarant" value="{{ old('nom_declarant') }}" required>
                                        @error('nom_declarant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="prenom_declarant" class="form-label">Prénom du déclarant <span style="color:red">*</label>
                                        <input type="text" class="form-control @error('prenom_declarant') is-invalid @enderror" 
                                            id="prenom_declarant" name="prenom_declarant" value="{{ old('prenom_declarant') }}" required>
                                        @error('prenom_declarant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Informations sur le défunt -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nom_defunt" class="form-label">Nom du défunt <span style="color:red">*</label>
                                        <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" 
                                            id="nom_defunt" name="nom_defunt" value="{{ old('nom_defunt') }}" required>
                                        @error('nom_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_defunt" class="form-label">Prénom du défunt <span style="color:red">*</label>
                                        <input type="text" class="form-control @error('prenom_defunt') is-invalid @enderror" 
                                            id="prenom_defunt" name="prenom_defunt" value="{{ old('prenom_defunt') }}" required>
                                        @error('prenom_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date_deces" class="form-label">Date de décès <span style="color:red">*</label>
                                        <input type="date" class="form-control @error('date_deces') is-invalid @enderror" 
                                            id="date_deces" name="date_deces" value="{{ old('date_deces') }}" required>
                                        @error('date_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Lieu de décès et localité -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="lieu_deces" class="form-label">Lieu de décès <span style="color:red">*</label>
                                        <input type="text" class="form-control @error('lieu_deces') is-invalid @enderror" 
                                            id="lieu_deces" name="lieu_deces" value="{{ old('lieu_deces') }}" required>
                                        @error('lieu_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_acte" class="form-label">Date de l'acte <span style="color:red">*</label>
                                        <input type="date" class="form-control @error('date_acte') is-invalid @enderror" 
                                            id="date_acte" name="date_acte" value="{{ old('date_acte', now()->format('Y-m-d')) }}" required>
                                        @error('date_acte')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Type de localité et localité -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type_localite" class="form-label">Type de localité <span style="color:red">*</label>
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
                                        <label for="localite_id" class="form-label">Localité <span style="color:red">*</label>
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

                                <!-- Filiation -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="filiation" class="form-label">Filiation du déclarant <span style="color:red">*</label>
                                        <select class="form-select @error('filiation') is-invalid @enderror" 
                                                id="filiation" name="filiation" required>
                                            <option value="" disabled selected>Choisir...</option>
                                            <option value="enfant" {{ old('filiation') == 'enfant' ? 'selected' : '' }}>Enfant</option>
                                            <option value="père" {{ old('filiation') == 'père' ? 'selected' : '' }}>Père</option>
                                            <option value="mère" {{ old('filiation') == 'mère' ? 'selected' : '' }}>Mère</option>
                                            <option value="frère" {{ old('filiation') == 'frère' ? 'selected' : '' }}>Frère</option>
                                            <option value="soeur" {{ old('filiation') == 'soeur' ? 'selected' : '' }}>Soeur</option>
                                            <option value="autre" {{ old('filiation') == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('filiation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Informations supplémentaires sur le défunt -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5>Informations sur la naissance du défunt</h5>
                                        <div class="mb-3">
                                            <label for="date_naissance" class="form-label">Date de naissance <span style="color:red">*</label>
                                            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                                id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                                            @error('date_naissance')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="lieu_naissance" class="form-label">Lieu de naissance <span style="color:red">*</label>
                                            <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                                id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}">
                                            @error('lieu_naissance')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h5>Informations sur le décès</h5>
                                        <div class="mb-3">
                                            <label for="cause_deces" class="form-label">Cause du décès <span style="color:red">*</label>
                                            <textarea class="form-control @error('cause_deces') is-invalid @enderror" 
                                                    id="cause_deces" name="cause_deces">{{ old('cause_deces') }}</textarea>
                                            @error('cause_deces')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="type_parent" class="form-label">Type de parenté <span style="color:red">*</label>
                                            <select class="form-select @error('type_parent') is-invalid @enderror" 
                                                id="type_parent" name="type_parent">
                                                <option value="" {{ old('type_parent') == '' ? 'selected' : '' }}>Sélectionner un type</option>
                                                <option value="père" {{ old('type_parent') == 'père' ? 'selected' : '' }}>Père</option>
                                                <option value="mère" {{ old('type_parent') == 'mère' ? 'selected' : '' }}>Mère</option>
                                            </select>
                                            @error('type_parent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nom_parent" class="form-label">Nom du parent</label>
                                            <input type="text" class="form-control @error('nom_parent') is-invalid @enderror" 
                                                id="nom_parent" name="nom_parent" value="{{ old('nom_parent') }}">
                                            @error('nom_parent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom_parent" class="form-label">Prénom du parent</label>
                                            <input type="text" class="form-control @error('prenom_parent') is-invalid @enderror" 
                                                id="prenom_parent" name="prenom_parent" value="{{ old('prenom_parent') }}">
                                            @error('prenom_parent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-md-12">
                                                <label for="documents" class="form-label">Documents justificatifs</label>
                                                <input type="file" class="form-control @error('documents') is-invalid @enderror" 
                                                    id="documents" name="documents[]" multiple>
                                                @error('documents')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <small class="text-muted">Vous pouvez uploader plusieurs fichiers (PDF, JPG, PNG - max 2MB chacun)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Enregistrer l'acte de décès
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
            // Chargement dynamique des localités
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