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
										<img class="h-auto max-h-14 w-36 object-contain" src="{{ asset('images/click-n-grow-logo.png') }}" alt="Click-N-Grow Agroventures">
						@elseif (!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo)))
										<img class="h-auto max-h-14 w-36 object-contain" src="{{ asset('storage/' . $setting->application_logo) }}" alt="KisanSAT Logo">
						@else
										<img class="h-auto max-h-14 w-36 object-contain" src="{{ asset('images/kisansat-logo.png') }}" alt="KisanSAT Logo">
						@endif
					</a>

				</div>
				<div class="navbar-center hidden lg:flex">
					<!-- Centered Menu -->
					<ul class="menu menu-horizontal space-x-4 px-4">
						<li><a href="{{ route('about') }}">{{ __('messages.about_us') }}</a></li>
						<li><a href="{{ route('contract') }}">{{ __('messages.contract') }}</a></li>
						<li><a href="{{ route('trading-export') }}">Trading and Export</a></li>
						<li><a href="{{ route('expert-visit-registration') }}">Expert Visit Registration</a></li>
						<li><a href="{{ route('blogs.index') }}">Blogs</a></li>

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
						<li><a href="{{ route('contact-us') }}">{{ __('messages.contact_us') }}</a></li>

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
            <footer class="relative isolate overflow-hidden bg-slate-950 text-white">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/hero_placeholder_img2.webp') }}');" aria-hidden="true"></div>
                <div class="absolute inset-0 bg-slate-950/40" aria-hidden="true"></div>
                <div class="relative z-10">
                    <section class="px-5 pb-8 pt-10 text-center sm:pb-9 sm:pt-12">
                        <h2 class="text-3xl font-bold leading-tight text-white sm:text-5xl">Ready to Grow a Healthier, Greener Tomorrow?</h2>
                        <p class="mt-3 text-lg text-white sm:text-2xl">Partner with Click-N-Grow and be a part of India’s herbal farming journey.</p>
                        <div class="mt-7 flex justify-center gap-6 text-2xl sm:gap-8" aria-label="Click-N-Grow social media">
                            <a class="hover:text-lime-300" href="https://www.facebook.com/FarmTradecom" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                            <a class="hover:text-lime-300" href="https://www.linkedin.com/company/89865876/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a class="hover:text-lime-300" href="https://www.instagram.com/herbal_contract_farming?dlrf=MXZzY2FhYmx6c2lyeA==" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a class="hover:text-lime-300" href="https://www.youtube.com/@ClickNGrowAgro" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </section>
                    <div class="mx-5 border-t border-white/50 sm:mx-8"></div>
                    <div class="mx-auto grid max-w-[1500px] gap-9 px-6 py-8 sm:grid-cols-2 lg:grid-cols-[1.25fr_1.2fr_1.35fr_1fr] lg:gap-8 lg:px-9">
                        <section>
                            <h2 class="mb-5 text-xl font-bold uppercase tracking-wide">Contact Us</h2>
                            <ul class="space-y-3 text-base leading-relaxed sm:text-lg">
                                <li class="flex gap-3"><i class="fas fa-location-dot mt-1 shrink-0" aria-hidden="true"></i><span>C/17-18, 1st Floor, Dakshata Nagar Vyapar Sankul, Opp. New SP Office, Sindhi Camp Chowk, Mangrulpir Road, Akola, Maharashtra - 444001</span></li>
                                <li class="flex gap-3"><i class="fas fa-phone mt-1 shrink-0" aria-hidden="true"></i><a href="tel:+917775008660">+91 77750 08660</a></li>
                                <li class="flex gap-3"><i class="fas fa-phone mt-1 shrink-0" aria-hidden="true"></i><a href="tel:+917028301210">+91 70283 01210</a></li>
                                <li class="flex gap-3"><i class="fas fa-phone mt-1 shrink-0" aria-hidden="true"></i><a href="tel:+919096338660">+91 90963 38660</a></li>
                                <li class="flex gap-3"><i class="fas fa-envelope mt-1 shrink-0" aria-hidden="true"></i><a class="break-all" href="mailto:info.clickngrow@gmail.com">info.clickngrow@gmail.com</a></li>
                                <li class="flex gap-3"><i class="fas fa-envelope mt-1 shrink-0" aria-hidden="true"></i><a class="break-all" href="mailto:info@ekisanzone.com">info@ekisanzone.com</a></li>
                            </ul>
                        </section>
                        <section>
                            <h2 class="mb-5 text-xl font-bold uppercase tracking-wide">Quick Links</h2>
                            <ul class="space-y-3 text-base sm:text-lg">
                                <li><a class="hover:underline" href="{{ route('home') }}">Home</a></li>
                                <li><a class="hover:underline" href="{{ route('about') }}">About Us</a></li>
                                <li><a class="hover:underline" href="{{ route('contract') }}">Contract Farming</a></li>
                                <li><a class="hover:underline" href="{{ route('trading-export') }}">Trading &amp; Export</a></li>
                                <li><a class="hover:underline" href="{{ route('expert-visit-registration') }}">Expert Visit Registration</a></li>
                                <li><a class="hover:underline" href="{{ route('blogs.index') }}">Blogs</a></li>
                                <li><a class="hover:underline" href="{{ route('contact-us') }}">Contact Us</a></li>
                                <li><a class="hover:underline" href="{{ route('careers') }}">Careers</a></li>
                            </ul>
                        </section>
                        <section>
                            <h2 class="mb-5 text-xl font-bold uppercase tracking-wide">Our Services</h2>
                            <ul class="space-y-3 text-base sm:text-lg">
                                <li><a class="hover:underline" href="{{ route('contract') }}">Contract Farming</a></li>
                                <li><a class="hover:underline" href="{{ route('contract') }}#contract-crops">Crops Available for Contract Farming</a></li>
                                <li><a class="hover:underline" href="{{ route('trading-export') }}">Trading &amp; Export</a></li>
                                <li><a class="hover:underline" href="{{ route('trading-export') }}">Third Party Manufacturing</a></li>
                                <li><a class="inline-flex items-center gap-2 font-semibold hover:underline" href="{{ route('contract') }}"><i class="fas fa-magnifying-glass" aria-hidden="true"></i>See All Services</a></li>
                            </ul>
                        </section>
                        <section class="flex flex-col items-center lg:items-end">
                            <a class="inline-flex rounded-2xl bg-white p-4 shadow-lg" href="{{ route('home') }}" aria-label="Click-N-Grow Home"><img class="h-56 w-56 object-contain" src="{{ asset('images/Click N Grow Final Logo.jpg') }}" alt="Click-N-Grow Agroventures Pvt. Ltd."></a>
                            <div class="mt-5 flex justify-center gap-5 text-2xl lg:justify-end" aria-label="Click-N-Grow social media">
                                <a class="hover:text-lime-300" href="https://www.facebook.com/FarmTradecom" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                                <a class="hover:text-lime-300" href="https://www.linkedin.com/company/89865876/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                <a class="hover:text-lime-300" href="https://www.instagram.com/herbal_contract_farming?dlrf=MXZzY2FhYmx6c2lyeA==" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a class="hover:text-lime-300" href="https://www.youtube.com/@ClickNGrowAgro" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            </div>
                        </section>
                    </div>
                    <div class="mx-5 border-t border-white/50 sm:mx-8"></div>
                    <div class="px-5 py-5 text-center text-base sm:text-lg">© 2026 Click-N-Grow Agroventures Pvt. Ltd. All rights reserved. <span class="mx-1">|</span><a class="hover:underline" href="{{ route('privacy-policy') }}">Privacy Policy</a><span class="mx-1">|</span><a class="hover:underline" href="{{ route('terms-and-conditions') }}">Terms &amp; Conditions</a></div>
                </div>
            </footer>



		</div>
		<x-whats-app-button phoneNumber="9096338660"
			message="Hello, I am interested in Click-N-Grow's herbal farming and raw material services. Please share more details." />

		<div class="drawer-side z-50">
			<label class="drawer-overlay" for="custom-mobile-menu-drawer" aria-label="close sidebar"></label>
			<ul class="menu min-h-full w-80 bg-base-100 p-4">
				<li><a href="{{ route('about') }}"><b>{{ __('messages.about_us') }}</b></a></li>
				<li><a href="{{ route('contract') }}"><b>{{ __('messages.contract') }}</b></a></li>
				<li><a href="{{ route('trading-export') }}"><b>Trading and Export</b></a></li>
				<li><a href="{{ route('expert-visit-registration') }}"><b>Expert Visit Registration</b></a></li>
				<li><a href="{{ route('blogs.index') }}"><b>Blogs</b></a></li>
				<li><a href="{{ route('contact-us') }}"><b>{{ __('messages.contact_us') }}</b></a></li>
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
