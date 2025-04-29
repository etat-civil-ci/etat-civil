@extends('layouts.app')
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
						<li class="breadcrumb-item active" aria-current="page">Acte de mariage</li>
					</ol>
				</nav>
			</div>
			<!-- Title -->
			<h1 class="h2 text-white">Acte De Mariage</h1>
		</div>

<!-- Formulaire d'Acte de Naissance -->
<div class="container mt-6">
    <h2 class="text-center mb-4">Formulaire d'Acte de Mariage</h2>

    <form action="#" method="POST" enctype="multipart/form-data" class="row g-3">

        <div class="col-md-6">
            <label for="nom" class="form-label">Filiation du demandeur</label>
            <select class="form-select" id="sexe" name="sexe" required>
                <option selected disabled>Moi meme</option>
                <option value="">Père</option>
                <option value="">Mère</option>
                <option value="">Frère</option>
                <option value="">Soeur</option>
                <option value="">Autre</option>

            </select>
        </div>

        <!-- Prénom -->
        <div class="col-md-6">
            <label for="prenom" class="form-label">Numéro CNI du demandeur</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le prénom" required>
        </div>

        <!-- Nom -->
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom & Prenom du demandeur</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom" required>
        </div>

        <!-- Prénom -->
        <div class="col-md-6">
            <label for="prenom" class="form-label">Nom & Prenom de l'époux</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le prénom" required>
        </div>

        <div class="col-md-6">
            <label for="prenom" class="form-label">Nom & Prenom de l'épouse</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le prénom" required>
        </div>

        <!-- Date de naissance -->
        <div class="col-md-6">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
        </div>

        <!-- Lieu de naissance -->
        <div class="col-md-6">
            <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" placeholder="Entrer le lieu de naissance" required>
        </div>

        <!-- Sexe -->
        <div class="col-md-6">
            <label for="sexe" class="form-label">Sexe</label>
            <select class="form-select" id="sexe" name="sexe" required>
                <option selected disabled>Choisir...</option>
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
            </select>
        </div>

        <!-- Nom du père -->
        <div class="col-md-6">
            <label for="nom_pere" class="form-label">Nom du père</label>
            <input type="text" class="form-control" id="nom_pere" name="nom_pere" placeholder="Nom complet du père" required>
        </div>

        <!-- Nom de la mère -->
        <div class="col-md-6">
            <label for="nom_mere" class="form-label">Nom de la mère</label>
            <input type="text" class="form-control" id="nom_mere" name="nom_mere" placeholder="Nom complet de la mère" required>
        </div>

       <!-- Choix entre Commune et Sous-préfecture -->
        <div class="col-md-6">
            <label for="type_localite" class="form-label">Type de localité</label>
            <select class="form-select" id="type_localite" required onchange="afficherLocalites()">
                <option selected disabled>Choisir...</option>
                <option value="commune">Commune</option>
                <option value="sousprefecture">Sous-préfecture</option>
            </select>
        </div>

        <!-- Liste des Communes -->
        <div class="col-md-6" id="bloc_commune" style="display: none;">
            <label for="commune" class="form-label">Choisir la commune</label>
            <select class="form-select" id="commune" name="commune">
                <option selected disabled>Choisir...</option>
                <option value="Abobo">Abobo</option>
                <option value="Adjamé">Adjamé</option>
                <option value="Cocody">Cocody</option>
                <option value="Plateau">Plateau</option>
                <option value="Yopougon">Yopougon</option>
                <option value="Treichville">Treichville</option>
                <option value="Marcory">Marcory</option>
                <option value="Koumassi">Koumassi</option>
                <option value="Port-Bouët">Port-Bouët</option>
                <option value="Attécoubé">Attécoubé</option>
                <option value="Anyama">Anyama</option>
                <option value="San Pedro">San Pedro</option>
                <option value="Daloa">Daloa</option>
                <option value="Korhogo">Korhogo</option>
            </select>
        </div>

        <!-- Liste des Sous-préfectures -->
        <div class="col-md-6" id="bloc_sousprefecture" style="display: none;">
            <label for="sousprefecture" class="form-label">Choisir la sous-préfecture</label>
            <select class="form-select" id="sousprefecture" name="sousprefecture">
                <option selected disabled>Choisir...</option>
                <option value="Bingerville">Bingerville</option>
                <option value="Songon">Songon</option>
                <option value="Dabou">Dabou</option>
                <option value="Jacqueville">Jacqueville</option>
                <option value="Grand-Bassam">Grand-Bassam</option>
                <option value="Alépé">Alépé</option>
                <option value="Agboville">Agboville</option>
                <option value="Aboisso">Aboisso</option>
                <option value="Adiaké">Adiaké</option>
                <option value="Tiassalé">Tiassalé</option>
                <option value="Toumodi">Toumodi</option>
                <option value="Bondoukou">Bondoukou</option>
                <option value="Bouaké">Bouaké</option>
                <option value="Divo">Divo</option>
            </select>
        </div>

        <!-- JavaScript pour changer dynamiquement -->
        <script>
            function afficherLocalites() {
                var type = document.getElementById('type_localite').value;
                var blocCommune = document.getElementById('bloc_commune');
                var blocSousPrefecture = document.getElementById('bloc_sousprefecture');

                if (type === 'commune') {
                    blocCommune.style.display = 'block';
                    blocSousPrefecture.style.display = 'none';
                } else if (type === 'sousprefecture') {
                    blocCommune.style.display = 'none';
                    blocSousPrefecture.style.display = 'block';
                }
            }
        </script>


        <!-- Acte PDF (fichier) -->
        <div class="col-md-12">
            <label for="fichier_pdf" class="form-label">Fichier PDF de l'acte (optionnel)</label>
            <input type="file" class="form-control" id="fichier_pdf" name="fichier_pdf" accept=".pdf">
        </div>

        <!-- Bouton envoyer -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Enregistrer l'acte de mariage</button>
        </div>
    </form>
</div>


	</div>	
</section>
<!-- =======================
Main hero END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
@stop