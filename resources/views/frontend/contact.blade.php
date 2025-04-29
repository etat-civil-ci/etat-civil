@extends('layouts.app')
@section('content')
<!-- =======================
Main hero START -->
<section class="pt-xl-8">
	<div class="container">
		<div class="row g-4 g-xxl-5">
			<div class="col-xl-9 mx-auto">
				<!-- Image -->
				<img src="assets/images/bg/02.jpg" class="rounded" alt="contact-bg">

				<!-- Contact form START -->
				<div class="row mt-n5 mt-sm-n7 mt-md-n8">
					<div class="col-11 col-lg-9 mx-auto">
						<div class="card shadow p-4 p-sm-5 p-md-6">
							<!-- Card header -->
							<div class="card-header border-bottom px-0 pt-0 pb-5">
								<!-- Breadcrumb -->
								<nav class="mb-3" aria-label="breadcrumb">
									<ol class="breadcrumb breadcrumb-dots pt-0">
										<li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
										<li class="breadcrumb-item active" aria-current="page">Contact</li>
									</ol>
								</nav>
								<!-- Title -->
								<h1 class="mb-3 h3">Contactez-nous</h1>
								<p class="mb-0">Vous avez des questions ou besoin d’aide ? Notre équipe est à votre écoute ! <a href="mailto:yeboua.koffi@uvci.edu.ci">yeboua.koffi@uvci.edu.ci</a></p>
							</div>

							<!-- Card body & form -->
							<form class="card-body px-0 pb-0 pt-5 needs-validation" novalidate>
								<!-- Name -->
								<div class="input-floating-label form-floating mb-4">
									<input type="text" class="form-control bg-transparent" id="floatingName" placeholder="Password" required>
									<label for="floatingName">Nom</label>
								</div>
								<!-- Email -->
								<div class="input-floating-label form-floating mb-4">
									<input type="email" class="form-control bg-transparent" id="floatingInput" placeholder="name@example.com" required>
									<label for="floatingInput">Email</label>
								</div>
								<!-- Number -->
								<div class="input-floating-label form-floating mb-4">
									<input type="text" class="form-control bg-transparent" id="floatingNumber" placeholder="Password" required>
									<label for="floatingNumber">Numéro</label>
								</div>
								<!-- Message -->
								<div class="input-floating-label form-floating mb-4">
									<textarea class="form-control bg-transparent" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
									<label for="floatingTextarea2">Message</label>
								</div>
								<!-- Button -->
								<button class="btn btn-lg btn-primary mb-0">Envoie</button>
							</form>
						</div>
					</div>
				</div>
				<!-- Contact form END -->
			</div>
		</div> <!-- Row END -->
	</div>
</section>
<!-- =======================
Main hero END -->

<!-- =======================
Contact info & Map START -->
<Section class="py-0">
	<div class="container">
		<div class="row row-cols-1 row-cols-lg-3 g-4">
			<!-- Address info -->
			<div class="col">
				<div class="card card-body bg-light border p-sm-5">
					<!-- Icon -->
					<div class="mb-4"><i class="bi bi-geo-alt fa-xl text-primary"></i></div>
					<!-- Title -->
					<h6 class="mb-4">Adresse</h6>
					<!-- Office item -->
					<div class="d-flex align-items-center mb-2">
					</div>
					<address class="mb-0">Plateau, Boulevard Angoulvant
						Abidjan, Côte d'Ivoire</address>
				</div>
			</div>

			<!-- Email info -->
			<div class="col">
				<div class="card card-body bg-light border p-sm-5">
					<!-- Icon -->
					<div class="mb-4"><i class="bi bi-envelope fa-xl text-primary"></i></div>
					<!-- Title -->
					<h6 class="mb-3">Email</h6>
					<p>Notre équipe est à votre écoute ! </p>
					<a href="#" class="heading-color text-primary-hover text-decoration-underline mb-0">yeboua.koffi@uvci.edu.ci</a>
				</div>
			</div>

			<!-- Contact info -->
			<div class="col">
				<div class="card card-body bg-light border p-sm-5">
					<!-- Icon -->
					<div class="mb-4"><i class="bi bi-telephone fa-xl text-primary"></i></div>
					<!-- Title -->
					<h6 class="mb-3">Appelez-nous</h6>
					<p>Travaillons ensemble vers un objectif commun - contactez-nous !</p>
					<a href="#" class="heading-color text-primary-hover text-decoration-underline mb-0">(225) 0586591790</a>
				</div>
			</div>

		</div> <!-- Row END -->
	</div>

	<!-- Map -->
	<iframe class="w-100 h-200px h-lg-400px grayscale d-block mt-8" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.755348655346!2d-4.027905925018843!3d5.322857394734622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1eb6f8a5f0e21%3A0x2f9aacf2e1e5e9b5!2sPlateau%2C%20Abidjan%2C%20C%C3%B4te%20d%27Ivoire!5e0!3m2!1sfr!2sfr!4v1623256789045!5m2!1sfr!2sfr" style="margin-bottom: -5px;" aria-hidden="false" tabindex="0"></iframe>	

</Section>
<!-- =======================
Contact info & Map END -->
@stop


