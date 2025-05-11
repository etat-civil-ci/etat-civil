@extends('layouts.app')
@section('content')

<section>
	<div class="container pt-4 pt-sm-0">
		<!-- Hero START -->
		<div class="row g-4 g-xxl-5">
			<!-- Hero content START -->
			<div class="">
				<!-- Title -->
				<h1 class="mb-0 lh-base">Acte de naissance</h1>
				<p class="mb-0 mt-4">Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .
                    La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses parents et les mentions marginales lorsqu'elles existent.
                    Un extrait simple comporte uniquement les informations sur la personne concernée par l'acte de naissance.</p>
			</div>
			<!-- Hero content END -->

		</div>
		<!-- Hero END -->
	</div>
</section>
<!-- =======================
Main Banner END -->

<!-- =======================
About START -->
<section class="pt-0">
	<div class="container">
		<div class="row g-4 align-items-center">
			<!-- Image -->
			<div class="col-lg-6 position-relative">
				<!-- SVG decoration -->
				<figure class="position-absolute top-0 start-0 mt-n6 ms-n5 z-index-1">
					<svg width="117" height="98" viewBox="0 0 117 98" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path class="fill-mode" d="M53.9804 0.725277C52.9701 1.69222 52.9701 5.07654 53.9804 11.1683C54.9906 17.1634 55.7123 18.5654 57.5885 18.5654C58.3582 18.5654 59.128 18.3237 59.3685 18.0336C59.561 17.6952 59.2723 13.9241 58.7912 9.52449C58.1177 3.52942 57.6847 1.45049 57.0112 0.773624C55.9047 -0.241669 54.9425 -0.290017 53.9804 0.725277Z"></path>
						<path class="fill-mode" d="M94.055 9.62103C87.2236 16.3413 84.8182 19.3872 85.0106 21.2244C85.1068 22.3847 85.3955 22.7715 86.3095 22.9165C87.2236 23.0616 88.3782 22.2397 91.6015 19.0004C96.9415 13.7305 101.512 8.46069 101.512 7.54209C101.512 6.62349 100.165 5.31812 99.2026 5.31812C98.7696 5.36646 96.4604 7.25201 94.055 9.62103Z"></path>
						<path class="fill-mode" d="M23.2866 15.2294C22.2763 15.8096 22.1801 17.5984 23.046 18.7104C24.1044 20.0641 34.0148 25.9625 35.2656 25.9625C35.891 25.9625 36.7088 25.6241 37.0937 25.2373C38.537 23.4001 36.4202 21.1278 29.1077 16.5348C25.9806 14.6492 24.7779 14.3108 23.2866 15.2294Z"></path>
						<path class="fill-mode" d="M103.433 40.37L97.8047 41.4337V42.8357C97.8047 43.851 98.1414 44.4312 99.0555 45.0114C100.21 45.6399 101.124 45.6399 107.09 44.8663C116.038 43.7543 116.038 43.7543 116.663 42.3523C117.096 41.337 117.048 40.9985 116.326 40.1283C115.22 38.8713 110.986 38.9196 103.433 40.37Z"></path>
						<path class="fill-mode" d="M3.94616 46.1232C0.193694 46.8485 -1.20145 49.2175 1.20397 50.7646C1.97371 51.2481 2.83967 51.4414 3.80184 51.1997C4.57157 51.0547 8.42026 50.7162 12.4133 50.5228C17.8495 50.2328 19.7739 49.9427 20.3512 49.4109C21.5058 48.2505 20.3993 46.8001 17.8495 46.1232C15.3479 45.4947 7.12133 45.4947 3.94616 46.1232Z"></path>
						<path class="fill-mode" d="M89.1454 69.9584C88.9529 70.1034 88.8086 70.7803 88.8086 71.4088C88.8086 72.7142 90.2518 73.8262 97.6125 77.9357C103.915 81.465 104.877 81.7551 106.416 80.4981C108.244 79.0477 107.234 77.5006 102.664 74.8898C95.3032 70.6352 90.3 68.7981 89.1454 69.9584Z"></path>
						<path class="fill-mode" d="M30.8398 72.8111C28.3382 74.9384 21.2181 86.9769 20.0635 91.038C19.0532 94.519 21.9397 95.9211 24.0565 93.0203C24.6819 92.1984 26.3657 89.2975 27.7609 86.6868C29.1079 84.0277 31.369 80.1115 32.6198 77.8876C34.929 74.0681 35.2177 72.8111 33.9187 71.9408C33.0047 71.3123 32.3312 71.5541 30.8398 72.8111Z"></path>
						<path class="fill-mode" d="M60.9544 80.7401C60.1365 81.707 60.0884 93.6488 60.9063 95.7277C61.243 96.4529 62.0128 97.3232 62.7825 97.6616C63.889 98.1935 64.1776 98.1451 65.0436 97.0815C65.5247 96.4529 65.8133 95.631 65.669 95.1959C65.5247 94.8091 65.2841 91.6666 65.0917 88.2823C64.9474 84.8979 64.6106 81.6103 64.4182 80.9818C63.889 79.6764 61.9165 79.5314 60.9544 80.7401Z"></path>
					</svg>
				</figure>
				<!-- Image -->
				<img src="assets/images/about/14.jpg" class="rounded" alt="about-img">
			</div>
			<!-- Content -->
			<div class="col-lg-6 ps-md-5">
				<h2 class="mb-4">Déclaration de Naissance</h2>
				<p class="mb-0">Comment faire la déclaration de naissance</p>

				<hr class="my-4">
				<p>il faut :</p>

				<!-- List -->
				<div class="row row-cols-1 ">
					<div class="col">
						<ul class="list-group list-group-borderless mb-0">
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i> Un Certificat de naissance comportant le numéro d’enregistrement, la signature du médecin ou de la sage-femme et le cachet du Centre médical</li>
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i>Une pièce d'identité de la mère(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )</li>
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i>Une pièce d'identité du père(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )</li>
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i> Une Copie de l'acte de mariage si vous êtes mariéS
                                Délai : trois (03) mois à compter du jour de la naissance.</li>
						</ul>
					</div>
					{{-- <div class="col">
						<ul class="list-group list-group-borderless mb-0">
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i>Performance Analytics</li>
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i>Fast Loading Speed</li>
							<li class="list-group-item d-flex"><i class="bi bi-patch-check-fill text-primary me-2"></i>Tested on Major Browsers</li>
						</ul>
					</div> --}}
				</div>

				<!-- Button -->
				<div class="text-center d-inline-block bg-dark rounded px-5 py-3 mt-4 mt-lg-5">
					<span class="text-white">Avez vous déjà un extrait?</span> <a class="ms-2" href="">Nouvel extrait<span class="bi-chevron-right small ms-1"></span></a>
				</div>
			</div>
		</div> <!-- Row END -->

		<!-- Value START -->
		<div class="row g-4 mt-5">
			<!-- Item -->
			<div class="col-sm-6 col-lg-3">
				<div class="card card-body bg-transparent p-0">
					<!-- Icon -->
					<figure class="text-primary mb-3 flex-shrink-0">
						<svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.36646 21.5H15.6485C15.9713 21.5 16.1327 21.5 16.269 21.4901C18.1249 21.3547 19.6008 19.8788 19.7362 18.0228C19.7462 17.8866 19.7462 17.7252 19.7462 17.4023C20.8592 17.3842 21.752 16.4767 21.752 15.3636V13.1074C21.752 11.9996 20.8539 11.1016 19.7462 11.1016C19.7462 10.7751 19.7462 10.6119 19.736 10.4741C19.5993 8.62062 18.1255 7.14688 16.272 7.01016C16.1343 7 15.9711 7 15.6446 7H12.625V5.5C13.2463 5.5 13.75 4.99632 13.75 4.375V3.875C13.75 2.97754 13.0225 2.25 12.125 2.25H11.875C10.9775 2.25 10.25 2.97754 10.25 3.875V4.37891C10.25 4.99807 10.7519 5.5 11.3711 5.5V7H8.37037C8.04391 7 7.88069 7 7.74294 7.01016C5.88942 7.14688 4.41569 8.62062 4.27897 10.4741C4.26881 10.6119 4.26881 10.7751 4.26881 11.1016C3.15385 11.1016 2.25 12.0054 2.25 13.1204V15.3835C2.25 16.4985 3.15385 17.4023 4.26881 17.4023C4.26881 17.7252 4.26881 17.8866 4.27874 18.0228C4.41412 19.8788 5.89005 21.3547 7.746 21.4901C7.88222 21.5 8.04364 21.5 8.36646 21.5Z" fill="currentColor" fill-opacity="0.25"/>
							<path d="M15 16.75H9M14.25 11.75V11.75C14.6642 11.75 15 12.0858 15 12.5V12.5C15 12.9142 14.6642 13.25 14.25 13.25V13.25C13.8358 13.25 13.5 12.9142 13.5 12.5V12.5C13.5 12.0858 13.8358 11.75 14.25 11.75ZM9.75 11.75V11.75C10.1642 11.75 10.5 12.0858 10.5 12.5V12.5C10.5 12.9142 10.1642 13.25 9.75 13.25V13.25C9.33579 13.25 9 12.9142 9 12.5V12.5C9 12.0858 9.33579 11.75 9.75 11.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</figure>
					<h6>Innovation-driven</h6>
					<p class="mb-0">Elevate your digital presence with our innovation-driven approach</p>
				</div>
			</div>

			<!-- Item -->
			<div class="col-sm-6 col-lg-3">
				<div class="card card-body bg-transparent p-0">
					<!-- Icon -->
					<figure class="text-primary mb-3 flex-shrink-0">
						<svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.5 18.55C8.5 18.27 8.5 18.13 8.5545 18.023C8.60243 17.9289 8.67892 17.8524 8.773 17.8045C8.87996 17.75 9.01997 17.75 9.3 17.75H14.7C14.98 17.75 15.12 17.75 15.227 17.8045C15.3211 17.8524 15.3976 17.9289 15.4455 18.023C15.5 18.13 15.5 18.27 15.5 18.55C15.5 19.6701 15.5 20.2302 15.282 20.658C15.0903 21.0343 14.7843 21.3403 14.408 21.532C13.9802 21.75 13.4201 21.75 12.3 21.75H11.7C10.5799 21.75 10.0198 21.75 9.59202 21.532C9.21569 21.3403 8.90973 21.0343 8.71799 20.658C8.5 20.2302 8.5 19.6701 8.5 18.55Z" fill="currentColor"/>
							<path d="M9.14722 16.75H14.8528C14.999 16.75 15.0721 16.75 15.1322 16.7348C15.3106 16.6899 15.4499 16.5506 15.4948 16.3722C15.51 16.3121 15.51 16.239 15.51 16.0928V15.7267C15.51 15.3829 15.6239 15.0488 15.834 14.7766L17.2527 12.938C20.6184 8.57623 17.5093 2.25 12 2.25C6.49069 2.25 3.38158 8.57623 6.74727 12.938L8.16605 14.7766C8.37608 15.0488 8.49 15.3829 8.49 15.7267V16.0928C8.49 16.239 8.49 16.3121 8.50517 16.3722C8.55014 16.5506 8.68941 16.6899 8.86777 16.7348C8.92795 16.75 9.00104 16.75 9.14722 16.75Z" fill="currentColor" fill-opacity="0.25"/>
							<path d="M10.5 11.5L12 14L13.5 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</figure>
					<h6>Transparent approach</h6>
					<p class="mb-0">At our digital agency, transparency isn't just a buzzword</p>
				</div>
			</div>

			<!-- Item -->
			<div class="col-sm-6 col-lg-3">
				<div class="card card-body bg-transparent p-0">
					<!-- Icon -->
					<figure class="text-primary mb-3 flex-shrink-0">
						<svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.0508 20.9081L16.9676 19.7107C18.3713 19.1344 19.0731 18.8463 19.5819 18.3633C19.9838 17.9818 20.2961 17.5159 20.4964 16.9993C20.75 16.3452 20.75 15.5865 20.75 14.0692C20.75 13.8719 20.75 13.7733 20.707 13.7098C20.6734 13.6603 20.6232 13.6244 20.5655 13.6087C20.4915 13.5886 20.3982 13.6206 20.2116 13.6846L12.5838 16.2998C12.327 16.3879 12.1986 16.4319 12.066 16.4407C12.0221 16.4436 11.9779 16.4436 11.934 16.4407C11.8014 16.4319 11.673 16.3879 11.4162 16.2998L3.78841 13.6846C3.60183 13.6206 3.50854 13.5886 3.43453 13.6087C3.37677 13.6244 3.32656 13.6603 3.293 13.7098C3.25 13.7733 3.25 13.8719 3.25 14.0692C3.25 15.5865 3.25 16.3452 3.50359 16.9993C3.70391 17.5159 4.01625 17.9818 4.41813 18.3633C4.9269 18.8463 5.62873 19.1344 7.03239 19.7107L7.03239 19.7107L9.94924 20.9081C10.8475 21.2769 11.2967 21.4613 11.7665 21.4979C11.9219 21.5101 12.0781 21.5101 12.2335 21.4979C12.7033 21.4613 13.1525 21.2769 14.0508 20.9081L14.0508 20.9081Z" fill="currentColor" fill-opacity="0.25"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M9.25035 5C9.25035 3.48122 10.4816 2.25 12.0003 2.25C13.5191 2.25 14.7503 3.48122 14.7503 5C14.7503 6.25878 13.9046 7.32002 12.7503 7.64648V8.24568L19.3266 10.8794C20.1324 11.2021 20.5353 11.3635 20.594 11.6181C20.6121 11.6967 20.611 11.7785 20.5907 11.8565C20.5248 12.1094 20.1176 12.2594 19.3031 12.5594L12.3115 15.1351C12.1748 15.1854 12.1065 15.2106 12.0356 15.2156C12.0121 15.2172 11.9886 15.2172 11.9651 15.2156C11.8942 15.2106 11.8259 15.1854 11.6892 15.1351L4.6976 12.5594C3.88311 12.2594 3.47586 12.1094 3.41002 11.8565C3.38969 11.7785 3.38855 11.6967 3.40668 11.6181C3.46543 11.3635 3.86832 11.2021 4.6741 10.8794L11.2503 8.24568V7.64648C10.0961 7.32002 9.25035 6.25878 9.25035 5Z" fill="currentColor"/>
						</svg>
					</figure>
					<h6>Accessible technology</h6>
					<p class="mb-0">Celebrate Inclusivity with Accessible Technology.</p>
				</div>
			</div>

			<!-- Item -->
			<div class="col-sm-6 col-lg-3">
				<div class="card card-body bg-transparent p-0">
					<!-- Icon -->
					<figure class="text-primary mb-3 flex-shrink-0">
						<svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3 7C5.43353 4.50359 8.57297 3 12 3C15.427 3 18.5665 4.50359 21 7M18.5 10.7328C16.6095 8.84054 14.3868 7.75 12.0086 7.75C9.62315 7.75 7.39426 8.84716 5.5 10.75M8.25 14.25C9.29028 13.1521 10.59 12.5 12 12.5C13.41 12.5 14.7097 13.1521 15.75 14.25" stroke="currentColor" stroke-opacity="0.25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M14.5 19.25C14.5 20.6307 13.3807 21.75 12 21.75C10.6193 21.75 9.5 20.6307 9.5 19.25C9.5 17.8693 10.6193 16.75 12 16.75C13.3807 16.75 14.5 17.8693 14.5 19.25Z" fill="currentColor"/>
						</svg>
					</figure>
					<h6>Collaborative teamwork</h6>
					<p class="mb-0">We believe that the best results are born from the synergy of diverse</p>
				</div>
			</div>
		</div>
		<!-- Value END -->
	</div>
</section>
<!-- =======================
About END -->

@stop