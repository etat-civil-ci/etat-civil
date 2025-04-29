
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mizzle.webestica.com/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:54 GMT -->
<head>

	<title>Mizzle - Technology and Corporate Bootstrap Theme</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Technology and Corporate Bootstrap Theme">

	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')
 
		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})

			}
		})
		
	</script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
	
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->
<main>
		<div class="row g-0">
			<!-- left -->

			<!-- Right -->
			<div class="col-sm-10 col-lg-5 d-flex m-auto vh-100">
				<div class="row w-100 m-auto">
					<div class="col-lg-10 my-5 m-auto">
			
						<a href="{{ route('home') }}"><img src="assets/images/image.png" class="h-50px mb-4" alt="logo"></a>
			
						<h2 class="mb-0">Crée ton
							<span class="position-relative">Compte
								<!-- SVG START -->
								<span class="position-absolute top-50 start-50 translate-middle z-index-n1 ms-n2 mt-2 d-none d-sm-block">
									<svg width="150.1px" height="20.7px" viewBox="0 0 150.1 20.7" style="enable-background:new 0 0 150.1 20.7;" xml:space="preserve">
										<path class="fill-primary" d="M10.7,12.2c-0.8,0.2-1.7,0.4-2.3,1.1C9.3,13,10.1,12.9,10.7,12.2 M63.6,1.9c3.3,0.3,6.7,0.1,10,0.2 c4.8,0.1,9.6,0.2,14.4,0.7c2.9,0.3,5.9,0.3,8.8,0.8c6.9,1,13.7,1.8,20.6,3.1c5.5,1.1,11,2.1,16.4,3.3c4.8,1.1,9.5,2.6,14.3,4 c0.7,0.2,1.3,0.5,1.7,1c-0.3,0.6-0.8-0.2-1.1,0.3c0.3,0.4,1.6,0.2,1.2,1c-0.3,0.6-1.2,1.1-2.2,1c-1.4-0.2-2.6-1-4-1.3 c-6.1-1.4-12.2-3-18.4-4c-3.8-0.6-7.6-1.4-11.5-1.7c-2.1-0.2-4.1-1-6.3-0.9c-0.5,0-1-0.3-1.6,0.2c-0.2,0.2-1,0.5-1.1-0.5 c0-0.2-0.4-0.1-0.6-0.2c-2.5-0.2-5-0.8-7.5-0.7c-2.4,0.1-4.8-0.3-7.2-0.3c-1.7,0-3.3-0.8-5.1-0.7c-0.7,0-1.5-0.1-2.2,0.2 c-0.3,0-0.5-0.1-0.8-0.1c-1.8-0.3-3.7-0.5-5.5-0.2c-1.9-0.4-3.9-0.4-5.8-0.1C68.1,7,66.1,6.8,64,7.4c-0.9,0.3-1.8,0.1-2.8,0.2 c-3.1,0.3-6.3,0.6-9.4,0.8c-0.6,0-1.2,0.3-1.8-0.2c-1.6-0.2-3.2,0-4.8,0.5c-1.6,0.5-3.2,0.4-4.8,0.5c-2.1,0.2-4.1,0.4-6,1.2 c-1.6,0.7-3.5,0.5-5.2,0.9c-3.8,0.9-7.7,1.6-11.2,3.2c-3.8,1.7-8,2.4-11.7,4.4c-0.9,0.5-1.7,1.3-2.8,1.6c-1.1,0.3-2.8-0.3-3.4-1.5 c-0.5-1-0.3-2.1,0.6-2.9c1.7-1.4,3.5-2.5,5.4-3.5c8.2-4.3,16.9-7,25.9-9c8.8-1.9,17.7-3,26.7-3.5C63.5-0.1,68.1,0,72.6,0 c4.7,0,9.4,0.1,14.1,0.5c4.2,0.4,8.3,0.9,12.5,1.4c4.9,0.6,9.7,1.3,14.5,2.1c11.6,2.1,23.1,4.4,34.2,8.4c0.7,0.3,1.7,0.1,2.2,1.1 c-0.9,0.4-1.7,0.1-2.4-0.1c-5.7-2-11.6-3.5-17.4-4.9c-8.7-2.1-17.5-3.3-26.3-4.7c-4.2-0.7-8.6-0.9-12.8-1.5 c-5.6-0.7-11.3-0.9-16.9-1.1c-3.4-0.1-6.8-0.1-10.1,0.3C63.9,1.6,63.7,1.7,63.6,1.9c-0.6-0.5-1.2-0.2-1.9-0.2 C56.9,1.9,52,2.3,47.1,2.8C44.1,3.1,41.1,3.7,38,4c-3.2,0.4-6.4,1.2-9.5,2.1c-0.9,0.2-2.1,0-2.7,1.1c-1.4-0.5-2.5,0.4-3.6,1 c1.2-0.2,2.5-0.4,3.6-1c0.3,0,0.7,0,1-0.1c9.1-2.3,18.4-3.7,27.7-4.4C57.6,2.4,60.6,2.2,63.6,1.9"/>
									</svg>
								</span>
								<!-- SVG END -->
							</span>
						</h2>
						<!-- Form START -->
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<!-- Name -->
							<div class="input-floating-label form-floating mb-4">
								<input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom" required>
								<label for="name">Nom</label>
							</div>
							
							<!-- Email -->
							<div class="input-floating-label form-floating mb-4">
								<input type="email" class="form-control" id="email" name="email" placeholder="nom@exemple.com" required>
								<label for="email">Adresse email</label>
							</div>
							
							<!-- Date de naissance -->
							<div class="input-floating-label form-floating mb-4">
								<input type="date" class="form-control" id="date_naissance" name="date_naissance" placeholder="Date de naissance">
								<label for="date_naissance">Date de naissance</label>
							</div>
							
							<!-- Genre -->
							<div class="mb-4">
								<label class="form-label">Genre</label>
								<div class="d-flex">
									<div class="form-check me-4">
										<input class="form-check-input" type="radio" name="genre" id="genre_homme" value="homme">
										<label class="form-check-label" for="genre_homme">Homme</label>
									</div>
									<div class="form-check me-4">
										<input class="form-check-input" type="radio" name="genre" id="genre_femme" value="femme">
										<label class="form-check-label" for="genre_femme">Femme</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="genre" id="genre_autre" value="autre">
										<label class="form-check-label" for="genre_autre">Autre</label>
									</div>
								</div>
							</div>
							
							<!-- Contact -->
							<div class="input-floating-label form-floating mb-4">
								<input type="text" class="form-control" id="contact" name="contact" placeholder="Entrez votre numéro de contact">
								<label for="contact">Contact</label>
							</div>
							
							<!-- Password -->
							<div class="input-floating-label form-floating mb-4">
								<input type="password" class="form-control fakepassword pe-6" id="password" name="password" placeholder="Entrez votre mot de passe" required>
								<label for="password">Mot de passe</label>
								<span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
									<i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
								</span>
							</div>
							
							<!-- Confirm Password -->
							<div class="input-floating-label form-floating mb-4">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
								<label for="password_confirmation">Confirmer le mot de passe</label>
							</div>
			
							<!-- Button -->
							<div class="align-items-center mt-0">
								<div class="d-grid">
									<button class="btn btn-dark mb-0" type="submit">Créer un compte</button>
								</div>
							</div>
						</form>
						<!-- Form END -->
			
						<!-- Sign IN link -->
						<div class="mt-4 text-center">
							<span>Vous avez déjà un compte ? <a href="{{ route('login') }}">Connectez-vous ici</a></span>
						</div>
						
					</div>
				</div>
			</div>
		</div>
</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- Back to top -->
<div class="back-top"></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!--Vendors-->
<script src="assets/vendor/pswmeter/pswmeter.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Theme Functions -->
<script src="assets/js/functions.js"></script>

</body>

<!-- Mirrored from mizzle.webestica.com/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:55 GMT -->
</html>