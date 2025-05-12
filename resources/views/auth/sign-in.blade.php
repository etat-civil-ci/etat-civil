
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mizzle.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:55 GMT -->
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

			<!-- Right -->
			<div class="col-sm-10 col-lg-5 d-flex m-auto vh-100">
				<div class="row w-100 m-auto">
					<div class="col-sm-10 my-5 m-auto">
			
						<a href="{{ route('home') }}"><img src="assets/images/image.png" class="h-50px mb-4" alt="logo"></a>
			
						<h2 class="mb-0">Bienvenue</h2>
						<p class="mb-0">Veuillez entrer vos identifiants pour vous connecter</p>
						

						{{Hash::make('1234')}}
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						
						@if(session('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{ session('error') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
					
						<!-- Form START -->
						<form method="POST" action="{{ route('login.authenticate') }}">
							@csrf
							<!-- Email -->

							@if (Session::get('withErrors'))
							<b>{{Session::get('withErrors')}}</b>
							@endif
							<div class="input-floating-label form-floating mb-4">
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="nom@exemple.com" value="{{ old('email') }}" required>
								<label for="email">Adresse email</label>
								@error('email')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
			
							<!-- Password -->
							<div class="input-floating-label form-floating mb-4 position-relative">
								<input type="password" class="form-control fakepassword pe-6 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Entrez votre mot de passe" required>
								<label for="password">Mot de passe</label>
								<span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
									<i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
								</span>
								@error('password')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
			
							<!-- Check box -->
							<div class="mb-4 d-flex justify-content-between">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<label class="form-check-label" for="remember">
										Se souvenir de moi
									</label>
								</div>
								<a href="{{ route('password.request') }}" class="link-underline-primary">Mot de passe oublié?</a>
							</div>
			
							<!-- Button -->
							<div class="align-items-center mt-0">
								<div class="d-grid">
									<button class="btn btn-dark mb-0" type="submit">Se connecter</button>
								</div>
							</div>
						</form>
						<!-- Form END -->
			
						<!-- Sign up link -->
						<div class="mt-4 text-center">
							<span>Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></span>
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
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Theme Functions -->
<script src="assets/js/functions.js"></script>

</body>

<!-- Mirrored from mizzle.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:55 GMT -->
</html>