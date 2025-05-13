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
						<li class="breadcrumb-item active" aria-current="page">Acte de naissance</li>
					</ol>
				</nav>
			</div>
			<!-- Title -->
			<h1 class="h2 text-white">Demande un acte de naissance</h1>
		</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('createactenaissance.store') }}" id="acteNaissanceForm" enctype="multipart/form-data">
                        @csrf

                        <!-- Informations sur le demandeur -->


                            <!-- Filiation -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>Informations du demandeur</h5>
                                <label for="filiation" class="form-label">Filiation du demandeur *</label>
                                <select class="form-select @error('filiation') is-invalid @enderror" 
                                        id="filiation" name="filiation" required>
                                    <option value="" disabled selected>Choisir...</option>
                                    <option value="moi" {{ old('filiation') == 'moi' ? 'selected' : '' }}>Moi-meme</option>
                                    <option value="père" {{ old('filiation') == 'père' ? 'selected' : '' }}>Père</option>
                                    <option value="mère" {{ old('filiation') == 'mère' ? 'selected' : '' }}>Mère</option>
                                    <option value="frère" {{ old('filiation') == 'frère' ? 'selected' : '' }}>Frère</option>
                                    <option value="soeur" {{ old('filiation') == 'soeur' ? 'selected' : '' }}>Soeur</option>
                                    <option value="autre" {{ old('filiation') == 'autre' ? 'selected' : '' }}>autre</option>
                                </select>
                                @error('filiation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom_demandeur" class="form-label">Nom du demandeur *</label>
                                <input type="text" class="form-control @error('nom_demandeur') is-invalid @enderror" 
                                       id="nom_demandeur" name="nom_demandeur" value="{{ old('nom_demandeur') }}" required>
                                @error('nom_demandeur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom_demandeur" class="form-label">Prénom du demandeur *</label>
                                <input type="text" class="form-control @error('prenom_demandeur') is-invalid @enderror" 
                                       id="prenom_demandeur" name="prenom_demandeur" value="{{ old('prenom_demandeur') }}" required>
                                @error('prenom_demandeur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <hr>  
                            
                            <h5>Informations de l'enfant </h5>
                       
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nom_enfant" class="form-label">Nom de l'enfant *</label>
                                <input type="text" class="form-control @error('nom_enfant') is-invalid @enderror" 
                                       id="nom_enfant" name="nom_enfant" value="{{ old('nom_enfant') }}" required>
                                @error('nom_enfant')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="prenom_enfant" class="form-label">Prénom de l'enfant *</label>
                                <input type="text" class="form-control @error('prenom_enfant') is-invalid @enderror" 
                                       id="prenom_enfant" name="prenom_enfant" value="{{ old('prenom_enfant') }}" required>
                                @error('prenom_enfant')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="date_naissance" class="form-label">Date de naissance *</label>
                                <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                       id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                                @error('date_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Lieu de naissance et localité -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="lieu_naissance" class="form-label">Lieu de naissance (établissement) *</label>
                                <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                       id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}" required>
                                @error('lieu_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                                <!-- Heure de naissance-->
                            <div class="col-md-6">
                                <label for="heure_naissance" class="form-label">Heure de naissance *</label>
                                <input type="time" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                       id="heure_naissance" name="heure_naissance" value="{{ old('heure_naissance') }}" required>
                                @error('heure_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_acte" class="form-label">Date de l'acte *</label>
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
                            <div class="row mb-6">
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

                        <hr>
                        <!-- Informations sur les parents -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>Informations du père *</h5>
                                <div class="mb-3">
                                    <label for="nom_pere" class="form-label">Nom</label>
                                    <input type="text" class="form-control @error('nom_pere') is-invalid @enderror" 
                                           id="nom_pere" name="nom_pere" value="{{ old('nom_pere') }}">
                                    @error('nom_pere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="prenom_pere" class="form-label">Prénom</label>
                                    <input type="text" class="form-control @error('prenom_pere') is-invalid @enderror" 
                                           id="prenom_pere" name="prenom_pere" value="{{ old('prenom_pere') }}">
                                    @error('prenom_pere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="domicile_pere" class="form-label">Domicile</label>
                                    <input type="text" class="form-control @error('domicile_pere') is-invalid @enderror" 
                                           id="domicile_pere" name="domicile_pere" value="{{ old('domicile_pere') }}">
                                    @error('domicile_pere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="profession_pere" class="form-label">Profession</label>
                                    <input type="text" class="form-control @error('profession_pere') is-invalid @enderror" 
                                           id="profession_pere" name="profession_pere" value="{{ old('profession_pere') }}">
                                    @error('profession_pere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="numero_cni_pere" class="form-label">Numéro CNI du père</label>
                                    <input type="text" class="form-control @error('numero_cni_pere') is-invalid @enderror" 
                                           id="numero_cni_pere" name="numero_cni_pere" value="{{ old('numero_cni_pere') }}">
                                    @error('numero_cni_pere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5>Informations de la mère *</h5>
                                <div class="mb-3">
                                    <label for="nom_mere" class="form-label">Nom *</label>
                                    <input type="text" class="form-control @error('nom_mere') is-invalid @enderror" 
                                           id="nom_mere" name="nom_mere" value="{{ old('nom_mere') }}" required>
                                    @error('nom_mere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="prenom_mere" class="form-label">Prénom *</label>
                                    <input type="text" class="form-control @error('prenom_mere') is-invalid @enderror" 
                                           id="prenom_mere" name="prenom_mere" value="{{ old('prenom_mere') }}" required>
                                    @error('prenom_mere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="domicile_mere" class="form-label">Domicile</label>
                                    <input type="text" class="form-control @error('domicile_mere') is-invalid @enderror" 
                                           id="domicile_mere" name="domicile_mere" value="{{ old('domicile_mere') }}">
                                    @error('domicile_mere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="profession_mere" class="form-label">Profession</label>
                                    <input type="text" class="form-control @error('profession_mere') is-invalid @enderror" 
                                           id="profession_mere" name="profession_mere" value="{{ old('profession_mere') }}">
                                    @error('profession_mere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="numero_cni_mere" class="form-label">Numéro CNI de la mère</label>
                                    <input type="text" class="form-control @error('numero_cni_mere') is-invalid @enderror" 
                                           id="numero_cni_mere" name="numero_cni_mere" value="{{ old('numero_cni_mere') }}">
                                    @error('numero_cni_mere')
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
                                    Enregistrer l'acte de naissance
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