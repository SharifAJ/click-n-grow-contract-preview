@props(['contract_var' => null, 'brand' => 'kisansat'])

<!DOCTYPE html>
<html data-theme="emerald" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<link href="{{ asset('images/hero_placeholder_img2.webp') }}" rel="preload" as="image">
	<link href="{{ asset('images/hero_placeholder_img2_mobile_version.webp') }}" rel="preload" as="image"
		media="(max-width: 768px)">


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description"
		content="KisanSAT offers satellite-based agriculture advisory services in India—featuring soil nutrient analysis, crop health monitoring, pest forewarning, irrigation planning, and 15-day weather forecasts. Boost yield, save water, and improve produce quality with expert agri insights.">
	<meta name="keywords"
		content="KisanSAT, Agriculture, Farming, Technology, Services, Kisan, Farmers, Crop Health, Soil Analysis, Weather Forecasting">
	<meta name="author" content="KisanSAT">

	@if (!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo)))
		<link type="image/x-icon" href="{{ asset('storage/' . $setting->application_logo) }}" rel="icon">
	@else
		<link type="image/x-icon" href="{{ asset('images/kisansat-logo.png') }}" rel="icon">
	@endif

	{{-- Fonts-  Headinng font is downloaded and imported in style.css file, this body font is imported via cdn --}}
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Cantora+One&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
		rel="stylesheet">
	<!-- Check if the local Font Awesome file exists -->
	@if (file_exists(public_path('css/font-awesome.min.css')))
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	@else
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	@endif

	{{-- STYLES --}}
	<!-- Link Swiper's CSS -->
	<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />

	<!-- Scripts -->
	<!-- jQuery must be on top of all scripts-->
	<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
		integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

	<!-- Swiper JS -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<!-- CounterUp JS -->
	<script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>

	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden">
	<!-- typography plugin applies its default styling to the text only inside prose container -->
	<!-- Navbar -->
	<div class="drawer">
		<input class="drawer-toggle" id="custom-mobile-menu-drawer" type="checkbox" />
		<div class="drawer-content flex flex-col">
			<div class="container navbar">
				<div class="navbar-start">
					<div class="flex-none lg:hidden">
						<label class="btn btn-square btn-ghost" for="custom-mobile-menu-drawer" aria-label="open sidebar">
							<i class="fas fa-bars"></i>
						</label>
					</div>

					@php
						$isContract = ($contract_var ?? null) === 'contract_page';
						$usesClickNGrowBrand = $isContract || $brand === 'click-n-grow';
					@endphp

					<a class="text-xl font-bold" href="{{ route('home') }}">
						@if ($usesClickNGrowBrand)
							<img class="w-20" src="{{ asset('images/Click N Grow Final Logo.jpg') }}" alt="Contract Logo">
						@elseif (!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo)))
							<img class="w-20" src="{{ asset('storage/' . $setting->application_logo) }}" alt="KisanSAT Logo">
						@else
							<img class="w-20" src="{{ asset('images/kisansat-logo.png') }}" alt="KisanSAT Logo">
						@endif
					</a>

				</div>
				<div class="navbar-center hidden lg:flex">
					<!-- Centered Menu -->
					<ul class="menu menu-horizontal space-x-4 px-4">
						<li><a href="{{ route('contract') }}">{{ __('messages.contract') }}</a></li>
						<li><a href="{{ route('about') }}">{{ __('messages.about_us') }}</a></li>
						<li><a href="{{ route('trading-export') }}">Trading and Export</a></li>
						<li><a href="{{ route('expert-visit-registration') }}">Expert Visit Registration</a></li>

						{{--
						<li><a href="#">{{ __('messages.home') }}</a></li>

						<li class="group dropdown dropdown-hover">
							<label class="flex cursor-pointer items-center space-x-2" tabindex="0">
								<span>{{ __('messages.important_links') }}</span>
								<i class="fas fa-chevron-down transition-transform duration-500 group-hover:text-emerald-600"></i>
							</label>
							<ul class="menu dropdown-content z-50 w-max rounded-[2px] bg-base-100 shadow-md">
								<li><a class="btn-primary" href="#">{{ __('messages.about_us') }}</a></li>
								<li><a href="#">{{ __('messages.grievance_redressal') }}</a></li>
								<li><a href="#">{{ __('messages.privacy_policy') }}</a></li>
								<li><a href="#">{{ __('messages.refund_policy') }}</a></li>
								<li><a href="#">{{ __('messages.terms_conditions') }}</a></li>
							</ul>
						</li>

						<li class="group dropdown dropdown-hover">
							<label class="flex cursor-pointer items-center space-x-2" tabindex="0">
								<span>{{ __('messages.services') }}</span>
								<i class="fas fa-chevron-down transition-transform duration-500 group-hover:text-emerald-600"></i>
							</label>
							<ul class="menu dropdown-content z-50 w-max rounded-[2px] bg-base-100 shadow-md">
								@php
									$services = [
									    'crop-calendar' => __('messages.crop_calendar'),
									    'crop-health-analysis' => __('messages.crop_health_analysis'),
									    'image-based-diagnosis' => __('messages.image_diagnosis'),
									    'land-area-mapping' => __('messages.land_mapping'),
									    'mandi-rates' => __('messages.mandi_rates'),
									    'optimal-irrigation' => __('messages.optimal_irrigation'),
									    'pest-and-disease-forewarning' => __('messages.pest_forewarning'),
									    'soil-moisture-estimation' => __('messages.soil_moisture'),
									    'soil-nutrient-analysis' => __('messages.soil_nutrient'),
									    'weather-forecasting' => __('messages.weather_forecasting'),
									];
								@endphp

								@foreach ($services as $slug => $name)
									<li>
										<a class="block px-4 py-2 hover:bg-gray-200" href="#">
											{{ $name }}
										</a>
									</li>
								@endforeach
							</ul>
						</li>

						<li><a href="#">{{ __('messages.faq') }}</a></li>
						--}}
						<li><a href="#">{{ __('messages.contact_us') }}</a></li>

						<li class="group dropdown dropdown-hover">
							<label class="flex cursor-pointer items-center space-x-2" tabindex="0">
								<span>{{ __('messages.language') }}</span>
								<i class="fas fa-chevron-down transition-transform duration-500 group-hover:text-emerald-600"></i>
							</label>
							<ul class="menu dropdown-content z-50 w-max rounded-[2px] bg-base-100 shadow-md">
								<li class="px-3">
									<a class="{{ session('applocale') == 'en' ? 'font-bold text-emerald-600' : '' }}"
										href="{{ route('change.language', 'en') }}">
										English
									</a>
								</li>
								<li class="px-3">
									<a class="{{ session('applocale') == 'hi' ? 'font-bold text-emerald-600' : '' }}"
										href="{{ route('change.language', 'hi') }}">
										हिन्दी
									</a>
								</li>
								<li class="px-3">
									<a class="{{ session('applocale') == 'mr' ? 'font-bold text-emerald-600' : '' }}"
										href="{{ route('change.language', 'mr') }}">
										मराठी
									</a>
								</li>
							</ul>
						</li>
					</ul>

				</div>
				<div class="navbar-end">
					<!-- Login/Register on the Right -->
					{{-- <ul class="menu menu-horizontal space-x-4 px-4">
							@if (Route::has('login'))
								@auth
									<li> <a href="{{ url('/dashboard') }}">Dashboard</a></li>
								@else
									<li><a href="{{ route('login') }}">Log in</a></li>
									@if (Route::has('register'))
										<li><a href="{{ route('register') }}">Register</a></li>
									@endif
								@endauth
							@endif
						</ul> --}}
				</div>
			</div>
			{{-- /* -------------------------------------------------------------------- Content ------------------------------------------------------------------- */ --}}
			<main>
				{{ $slot }}
			</main>

			@if (!isset($contract_var) || $contract_var !== 'contract_page')
				<footer class="relative bg-gradient-to-b from-slate-700 via-slate-800 to-slate-900 py-10 text-white">
					<div class="absolute inset-0 bg-cover bg-center opacity-70"
						style="background-image: url('{{ asset('images/hero_placeholder_img2.webp') }}');">
					</div>

					<div class="container relative z-10 border-gray-400 px-6 pt-6">
						<div class="mx-auto px-6 text-center">
							<h2 class="text-2xl font-bold sm:text-3xl md:text-4xl" data-aos="fade-up">
								{{ __('messages.footer.title') }}
							</h2>
							<p class="mt-2 text-sm opacity-90 sm:text-base md:text-lg" data-aos="fade-up" data-aos-delay="200">
								{{ __('messages.footer.desc') }}
							</p>
							<!-- Social Media Links -->
							<div class="mt-6 flex justify-center space-x-4 sm:space-x-6">
								<a class="transform transition hover:scale-110 hover:text-emerald-300"
									href="https://www.facebook.com/profile.php?id=100093467838017" target="_blank">
									<i class="fab fa-facebook text-xl sm:text-2xl"></i>
								</a>
								<a class="transform transition hover:scale-110 hover:text-emerald-300" href="https://x.com/kisan_sat"
									target="_blank">
									<i class="fab fa-twitter text-xl sm:text-2xl"></i>
								</a>
								<a class="transform transition hover:scale-110 hover:text-emerald-300"
									href="https://www.instagram.com/kisansat/?hl=en" target="_blank">
									<i class="fab fa-instagram text-xl sm:text-2xl"></i>
								</a>
								<a class="transform transition hover:scale-110 hover:text-emerald-300"
									href="https://youtube.com/@kisansat-smartfarmingsolutions?si=VTdyMUe24CWK77aJ" target="_blank">
									<i class="fab fa-youtube text-xl sm:text-2xl"></i>
								</a>
							</div>
						</div>

						<div
							class="my-4 grid grid-cols-1 gap-6 border-y border-gray-400 py-4 sm:grid-cols-2 md:grid-cols-2 md:gap-16 md:py-8 lg:grid-cols-4">
							<div>
								<h4 class="pb-2 text-lg font-bold uppercase sm:text-xl">
									{{ __('messages.footer.contact') }}
								</h4>
								<p class="mt-4 flex items-center text-sm sm:text-base">
									<i class="fas fa-map-marker-alt pr-2"></i> {{ $setting->company_address }}
								</p>
								<p class="mt-4 text-sm sm:text-base">
									<i class="fas fa-phone-alt fa-flip-horizontal pr-1"></i> <span
										class="font-semibold">{{ $setting->phone_number }}</span>
								</p>
								<p class="text-sm sm:text-base">
									<i class="fas fa-phone-alt fa-flip-horizontal pr-1"></i> <span class="font-semibold">+91-77750-08660</span>
								</p>
								<p class="mt-4 text-sm sm:text-base">
									<i class="fas fa-envelope pr-1"></i>
									<a class="font-semibold hover:underline" href="mailto:{{ $setting->company_email }}">
										{{ $setting->company_email }}
									</a>
								</p>
							</div>

							<div>
								<h4 class="pb-2 text-lg font-bold uppercase sm:text-xl">
									{{ __('messages.footer.quick_links') }}</h4>
								<ul class="mt-4 space-y-2 text-sm sm:text-base">
									<li><a class="transition hover:underline" href="{{ route('home') }}">{{ __('messages.footer.home') }}</a>
									</li>
									<li><a class="transition hover:underline" href="{{ route('about') }}">{{ __('messages.footer.about') }}</a>
									</li>
									<li><a class="transition hover:underline"
											href="{{ route('home') }}/#services">{{ __('messages.footer.services') }}</a>
									</li>
									<li><a class="transition hover:underline"
											href="{{ route('home') }}/#faq">{{ __('messages.footer.faq') }}</a></li>
									<li><a class="transition hover:underline"
											href="{{ route('contact-us') }}">{{ __('messages.footer.contact_us') }}</a>
									</li>
								</ul>
							</div>

							<div>
								<h4 class="pb-2 text-lg font-bold uppercase sm:text-xl">
									{{ __('messages.footer.services') }}</h4>
								<ul class="mt-4 space-y-2 text-sm sm:text-base">

									@foreach (__('messages.footer.service_list') as $slug => $name)
										<li>
											<a class="transition hover:underline" href="{{ route('services.show', ['service' => $slug]) }}">
												{{ $name }}
											</a>
										</li>
									@endforeach
									<li class="pt-3">
										<a class="transition hover:underline" href="{{ route('home') }}/#services">
											<i class="fas fa-search"></i> {{ __('messages.footer.see_all') }}
										</a>
									</li>
								</ul>
							</div>
							<!-- Logo & Social Links -->
							<div class="flex flex-col items-center text-center md:text-left">
								<div class="inline-block w-fit rounded-lg bg-white p-3 shadow-md">
									<img class="w-24 sm:w-32 md:w-40" src="{{ asset('storage/' . $setting->application_logo) }}"
										alt="KisanSAT Logo">
								</div>
								<div class="mt-4 flex justify-center space-x-4">
									<a class="hover:text-green-300" href="https://www.facebook.com/profile.php?id=100093467838017"
										target="_blank">
										<i class="fa-brands fa-facebook text-xl sm:text-2xl"></i>
									</a>
									<a class="hover:text-green-300" href="https://x.com/kisan_sat" target="_blank">
										<i class="fa-brands fa-twitter text-xl sm:text-2xl"></i>
									</a>
									<a class="hover:text-green-300" href="https://www.instagram.com/kisansat/?hl=en" target="_blank">
										<i class="fa-brands fa-instagram text-xl sm:text-2xl"></i>
									</a>
									<a class="hover:text-green-300" href="https://youtube.com/@kisansat-smartfarmingsolutions?si=VTdyMUe24CWK77aJ"
										target="_blank">
										<i class="fa-brands fa-youtube text-xl sm:text-2xl"></i>
									</a>
								</div>
							</div>
						</div>
						<!-- Footer Bottom -->
						<div class="text-center text-xs sm:text-sm">
							<p>{{ __('messages.footer.copyright') }} |
								<a class="hover:underline" href="{{ route('refund-policy') }}">{{ __('messages.footer.privacy') }}</a> |
								<a class="hover:underline" href="{{ route('terms-and-conditions') }}">{{ __('messages.footer.terms') }}</a>
							</p>
						</div>
					</div>
				</footer>
			@endif



		</div>
		<x-whats-app-button phoneNumber="9096248660" />

		<div class="drawer-side z-50">
			<label class="drawer-overlay" for="custom-mobile-menu-drawer" aria-label="close sidebar"></label>
			<ul class="menu min-h-full w-80 bg-base-100 p-4">
				<li><a href="{{ route('contract') }}"><b>{{ __('messages.contract') }}</b></a></li>
				<li><a href="{{ route('about') }}"><b>{{ __('messages.about_us') }}</b></a></li>
				<li><a href="{{ route('trading-export') }}"><b>Trading and Export</b></a></li>
				<li><a href="{{ route('expert-visit-registration') }}"><b>Expert Visit Registration</b></a></li>
				{{--
				<li><a href="#"><b>{{ __('messages.footer.home') }}</b></a></li>

				<details class="collapse">
					<summary class="collapse-title flex items-center space-x-2">
						<b>{{ __('messages.footer.important_links') }}</b>
						<i class="fas fa-chevron-down"></i>
					</summary>
					<div class="collapse-content text-sm">
						<ul>
							<li><a href="#">{{ __('messages.footer.about') }}</a></li>
							<li><a href="#">{{ __('messages.footer.grievance_redressal') }}</a></li>
							<li><a href="#">{{ __('messages.footer.privacy') }}</a></li>
							<li><a href="#">{{ __('messages.footer.refund_policy') }}</a></li>
							<li><a href="#">{{ __('messages.footer.terms') }}</a></li>
						</ul>
					</div>
				</details>

				<details class="collapse">
					<summary class="collapse-title flex items-center space-x-2">
						<b>{{ __('messages.footer.services') }}</b>
						<i class="fas fa-chevron-down"></i>
					</summary>
					<div class="collapse-content text-sm">
						<ul>
							@foreach (__('messages.footer.service_list') as $slug => $name)
								<li>
									<a class="block px-4 py-2 hover:bg-gray-200" href="#">
										{{ $name }}
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</details>

				<li><a href="#"><b>{{ __('messages.footer.faq') }}</b></a></li>
				--}}
				<li><a href="#"><b>{{ __('messages.footer.contact_us') }}</b></a></li>
			</ul>
		</div>
	</div>





	<script>
		// CounterUp2 initialization
		document.addEventListener("DOMContentLoaded", () => {
			// Get CounterUp2 from window object
			const counterUp = window.counterUp.default;

			// Select all counters
			const counters = document.querySelectorAll(".counter");

			counters.forEach(counter => {
				const observer = new IntersectionObserver(entries => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							counterUp(counter, {
								duration: 1000, // Animation speed
								delay: 16
							});
							observer.unobserve(
								counter); // Stop observing after animation runs
						}
					});
				}, {
					threshold: 0.5
				});

				observer.observe(counter);
			});
		});
	</script>
</body>

</html>
