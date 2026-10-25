<x-guest-layout>
	<link href="{{ asset('assets/glightbox.min.css') }}" rel="stylesheet">

	<!-- Hero Section -->
	<section class="swiper mySwiper h-[600px] w-full md:h-[85vh]">
		<div class="swiper-wrapper h-[600px] md:h-[85vh]">

			<!-- Slide 1: Video Background -->
			<div class="swiper-slide relative flex h-full items-center justify-center bg-white px-6 text-center text-[18px]"
				x-data="{ videoLoaded: false }">

				{{-- Placeholder Image --}}
				<picture x-show="!videoLoaded">
					<!-- Mobile image (loaded only when max-width ≤ 768px) -->
					<source srcset="{{ asset('images/hero_placeholder_img2_mobile_version.webp') }}" media="(max-width: 768px)">

					<!-- Default / Desktop image -->
					<img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/hero_placeholder_img2.webp') }}"
						alt="Loading Video" fetchpriority="high" decoding="async">
				</picture>


				<video class="absolute left-0 top-0 -z-10 h-full w-full object-cover" x-ref="video" x-init="$refs.video.playbackRate = 0.7;
	$refs.video.onloadeddata = () => videoLoaded = true" muted
					autoplay loop playsinline>

					<!-- Mobile MP4 -->
					<source src="{{ asset('videos/hero_video_bg_10s_mobile_version.mp4') }}" type="video/mp4"
						media="(max-width: 768px)">

					<!-- Desktop MP4 -->
					<source src="{{ asset('videos/hero_video_bg_10s.mp4') }}" type="video/mp4">

					Your browser does not support the video tag.
				</video>



				<div class="container relative z-10 flex h-full items-center justify-center">
					<div class="hero-content flex-col rounded-lg text-center text-white">
						<h1 class="text-4xl font-extrabold [text-shadow:_0_10px_16px_rgb(0_0_0_/_0.8)] md:text-4xl lg:text-5xl">
							{{ __('messages.hero_title') }}
						</h1>
					</div>
				</div>
			</div>

			<div class="swiper-slide bg-top-left flex bg-cover px-6 md:bg-center"
				style="background-image: url('{{ asset('images/hero_bg.jpg') }}');">
				<div
					class="container mx-auto flex flex-col items-center justify-start gap-10 ps-2 pt-10 md:flex-row md:justify-center md:gap-2 md:ps-10 md:pt-0">
					<!-- Left Side: Text Content -->
					<div
						class="animate-fade-in-left flex flex-col items-center gap-2 space-y-4 text-center md:basis-[700px] md:items-start md:text-left">
						<h1 class="text-4xl font-extrabold text-white md:text-5xl lg:text-6xl xl:text-6xl">
							{{ __('messages.hero_title_1') }} <br> {{ __('messages.hero_title_2') }}
						</h1>
						<p class="text-md font-bold text-white md:text-[1.4rem]">
							{{ __('messages.hero_description') }}
						</p>
						<!-- Better button implementation -->
						@if (filled(config('services.android_app_link')))
							<a
								class="btn-white text-md btn justify-start px-6 font-bold text-emerald-900 transition-all duration-300 hover:scale-105"
								href="{{ config('services.android_app_link') }}" target="_blank" rel="noopener noreferrer">
								<i class="fab fa-google-play pr-1 text-lg"></i>
								{{ __('messages.download_now') }}
							</a>
						@endif

					</div>

					<!-- Right Side: Mobile Screenshot -->
					<div class="animate-fade-in-right w-full" data-aos="zoom-in" data-aos-duration="1000">
						<img class="mx-auto" src="{{ asset('images/app_screenshots4x.png') }}" alt="KisanSAT Mobile App Preview"
							loading="lazy" />
					</div>
				</div>
			</div>

			{{-- <div class="swiper-slide bg-top-left flex bg-cover px-6 md:bg-center"
                style="background-image: url('{{ asset('images/hero-grow-more-bg.png') }}');">
                <div
                    class="container mx-auto flex flex-col items-center justify-center gap-2 pt-10 md:flex-row md:justify-end md:gap-16 md:pt-0">
                    <!-- Left Side: Text Content -->
                    <div
                        class="animate-fade-in-left flex flex-col items-center space-y-4 text-center md:w-[565px] md:items-start md:text-left">
                        <h1 class="text-4xl font-extrabold text-black md:text-5xl lg:text-6xl xl:text-6xl">
                            {{ __('messages.hero_title_1') }} <br> {{ __('messages.hero_title_2') }}
                        </h1>
                        <p class="text-md font-bold text-black md:text-2xl lg:text-3xl">
                            {{ __('messages.hero_description') }}
                        </p>
                        <!-- Better button implementation -->
                        <a class="inline-block transition-transform hover:scale-105" href="#">
                            <img class="w-48 md:w-56 lg:w-64" src="{{ asset('images/download_now_button.png') }}"
                                alt="Download Now Button" loading="lazy">
                        </a>
                    </div>

                    <!-- Right Side: Mobile Screenshot -->
                    <div class="animate-fade-in-right w-full md:w-[50%]" data-aos="zoom-in" data-aos-duration="1000">
                        <img class="mx-auto w-[300px] md:w-[400px] lg:w-[500px]"
                            src="{{ asset('images/mobile-screenshot.png') }}" alt="KisanSAT Mobile App Preview"
                            loading="lazy">
                    </div>
                </div>
            </div> --}}

		</div>
		<!-- Pagination -->
		<div class="swiper-pagination"></div>

		<!-- Swiper Navigation -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<style>
			.swiper-pagination-bullet {
				background-color: #fff;
				filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.5));
			}

			.swiper-button-next,
			.swiper-button-prev {
				color: #fff;
				filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.5));
			}
		</style>
	</section>

	{{-- Get started Section --}}
	<section class="relative bg-[#F2F7F5]">
		<div
			class="container mx-auto flex flex-col items-center justify-center gap-4 px-6 py-10 md:flex-row md:gap-20 md:px-20 md:py-20">
			<!-- Left Column: Text Content -->
			<div class="max-w-md space-y-4 text-center md:text-left">
				<h2 class="text-2xl font-bold text-gray-900 md:text-3xl">{{ __('messages.get_started_title') }}</h2>
				<p class="text-base text-gray-700 md:text-lg">{{ __('messages.get_started_desc') }}</p>
				@if (filled(config('services.android_app_link')))
					<a
						class="btn btn-primary inline-block rounded-md px-6 py-2 text-sm uppercase text-white md:px-10 md:py-3 md:text-lg"
						href="{{ config('services.android_app_link') }}" target="_blank" rel="noopener noreferrer">
						<i class="fas fa-download mr-2"></i> {{ __('messages.download_button') }}
					</a>
				@endif
			</div>

			<!-- Right Column: QR Code & Play Store Button -->
			<div class="mt-8 flex flex-col items-center space-y-4 md:mt-0">
				<img class="w-24 md:w-32" src="{{ asset('images/qr-code.jpg') }}" alt="QR Code">
				<span class="text-xs text-gray-600 md:text-sm">{{ __('messages.scan_text') }}</span>
			</div>
		</div>
	</section>



	<!-- Introduction Section -->
	<section class="py-14" id="about">
		<div class="container mx-auto px-4">
			<div class="flex flex-col items-center gap-2 md:gap-10 lg:flex-row lg:gap-16">
				<!-- Text Content -->
				<div class="lg:w-1/2" data-aos="fade-right">
					<h2 class="mb-4 text-3xl font-bold text-primary md:text-4xl">{{ __('messages.about_title') }}</h2>
					<p class="text-lg font-semibold text-gray-800 md:text-xl">
						{{ __('messages.about_description') }}
					</p>
					<br>
					{{-- <p class="text-base text-gray-700 md:text-lg">
                        {{ $setting->about_us }}
                    </p> --}}

					<p class="text-base text-gray-700 md:text-lg">
						{{ $setting['about_us_' . app()->getLocale()] ?? __('messages.default_about_us') }}
					</p>

				</div>

				<!-- Image -->
				<div class="mt-8 w-full lg:mt-0 lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
					<img class="w-full rounded-lg object-cover shadow-lg" src="{{ asset('images/about-us-1000x667.webp') }}"
						alt="Farmer using KisanSAT">
				</div>
			</div>
		</div>
	</section>

	{{-- Features Section  --}}
	<section class="relative bg-[#F2F7F5] py-14" id="services">
		<x-section-divider-top-waves />

		<div class="container px-4">
			<h2 class="mb-10 text-center text-4xl font-bold">{{ __('messages.our_services') }}</h2>
			<div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
				<!-- Satellite-based Soil Nutrient Analysis -->
				<!-- Soil Nutrient Analysis -->
				<x-feature-card title="{{ __('messages.service_1_title') }}" icon="fas fa-seedling"
					description="{{ __('messages.service_1_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'soil-nutrient-analysis') }}" />

				<!-- Pest and Disease Forecasting -->
				<x-feature-card title="{{ __('messages.service_2_title') }}" icon="fas fa-bug"
					description="{{ __('messages.service_2_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'pest-and-disease-forewarning') }}" />

				<!-- Crop Health Monitoring -->
				<x-feature-card title="{{ __('messages.service_3_title') }}" icon="fas fa-leaf"
					description="{{ __('messages.service_3_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'crop-health-analysis') }}" />

				<!-- Image-Based Diagnosis -->
				<x-feature-card title="{{ __('messages.service_4_title') }}" icon="fas fa-camera"
					description="{{ __('messages.service_4_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'image-based-diagnosis') }}" />

				<!-- Weather Forecast -->
				<x-feature-card title="{{ __('messages.service_5_title') }}" icon="fas fa-cloud-sun"
					description="{{ __('messages.service_5_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'weather-forecasting') }}" />

				<!-- Soil Moisture Estimation -->
				<x-feature-card title="{{ __('messages.service_6_title') }}" icon="fas fa-tint"
					description="{{ __('messages.service_6_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'soil-moisture-estimation') }}" />

				<!-- Crop Calendar -->
				<x-feature-card title="{{ __('messages.service_7_title') }}" icon="fas fa-calendar-alt"
					description="{{ __('messages.service_7_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'crop-calendar') }}" />

				<!-- Land Area Mapping -->
				<x-feature-card title="{{ __('messages.service_8_title') }}" icon="fas fa-map-marked-alt"
					description="{{ __('messages.service_8_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'land-area-mapping') }}" />

				<!-- Irrigation Requirement Estimation -->
				<x-feature-card title="{{ __('messages.service_9_title') }}" icon="fas fa-water"
					description="{{ __('messages.service_9_description') }}" button_name="{{ __('messages.our_services_button') }}"
					url="{{ route('services.show', 'optimal-irrigation') }}" />

				<!-- Mandi Rates -->
				<x-feature-card title="{{ __('messages.service_10_title') }}" icon="fas fa-clock"
					description="{{ __('messages.service_10_description') }}"
					button_name="{{ __('messages.our_services_button') }}" url="{{ route('services.show', 'mandi-rates') }}" />

			</div>
		</div>
		<x-section-divider-bottom-waves />

	</section>
	
	 <x-cta /> 

	{{-- Unlocking Benefits Section --}}

	<section class="py-14">
		<div class="container mx-auto px-4">
			<!-- Section Title -->
			<h2 class="mb-12 text-center text-4xl font-bold text-primary">
				{{ __('messages.unlocking_benefits_title') }}
			</h2>

			<!-- Cards Grid -->
			<div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
				<x-benefit-card value="{{ __('messages.benefit_1_value') }}"
					afterValue="{{ __('messages.benefit_1_afterValue') }}" beforeValue="{{ __('messages.benefit_1_beforeValue') }}"
					backgroundImage="{{ asset('images/water-saving.jpg') }}"
					description="{{ __('messages.benefit_1_description') }}" />

				<x-benefit-card value="{{ __('messages.benefit_2_value') }}"
					afterValue="{{ __('messages.benefit_2_afterValue') }}" beforeValue="{{ __('messages.benefit_2_beforeValue') }}"
					backgroundImage="{{ asset('images/input-saving.jpg') }}"
					description="{{ __('messages.benefit_2_description') }}" />

				<x-benefit-card value="{{ __('messages.benefit_3_value') }}"
					afterValue="{{ __('messages.benefit_3_afterValue') }}" beforeValue="{{ __('messages.benefit_3_beforeValue') }}"
					backgroundImage="{{ asset('images/farmer-happy.jpg') }}"
					description="{{ __('messages.benefit_3_description') }}" />

				<x-benefit-card value="{{ __('messages.benefit_4_value') }}"
					afterValue="{{ __('messages.benefit_4_afterValue') }}" beforeValue="{{ __('messages.benefit_4_beforeValue') }}"
					backgroundImage="{{ asset('images/yeild.jpg') }}" description="{{ __('messages.benefit_4_description') }}" />
			</div>
		</div>
	</section>





	{{-- FAQ SECTION --}}
	@php
		$appDownloadLink = config('services.android_app_link');
		$playStoreLink = filled($appDownloadLink)
		    ? '<u><a href="' . e($appDownloadLink) . '" target="_blank" rel="noopener noreferrer"><strong>Google Play Store</strong></a></u>'
		    : 'Google Play Store (link unavailable).';
		$faqs = [
		    [
		        'question' => 'What is KisanSAT?',
		        'answer' =>
		            'KisanSAT is a satellite-based platform that offers a suite of precision farming services, including soil nutrient analysis, pest and disease forecasting, weather updates, crop health monitoring, and more. We provide actionable insights for farmers to optimize their resources and boost crop yield.',
		    ],
		    [
		        'question' => 'How do I access KisanSAT’s services?',
		        'answer' =>
		            '1) Download our app from the ' .
		            $playStoreLink .
		            '.<br>
                     2) Create an account and verify your email.<br>
                     3) Add your field boundaries using our intuitive mapping tool.<br>
                     4) Choose your subscription plan based on your needs.<br>
                     5) Start receiving insights about your crops every day!',
		    ],
		    [
		        'question' => 'Do I need special equipment to use KisanSAT?',
		        'answer' =>
		            'No, all you need is an internet-enabled device (smartphone, tablet, or computer) to access the KisanSat platform. The system does not require any physical sensors or equipment on your farm.',
		    ],
		    [
		        'question' => 'How accurate is the soil nutrient analysis?',
		        'answer' =>
		            'Our satellite-based soil nutrient analysis is based on high-resolution satellite imagery, combined with AI-powered algorithms. It is highly accurate and helps you understand soil composition and nutrient deficiencies at a detailed level.',
		    ],
		    [
		        'question' => 'What types of crops can I monitor?',
		        'answer' =>
		            'KisanSAT supports a wide variety of crops, including staple crops like rice, wheat, maize, cotton, and vegetables, as well as horticultural crops and medicinal plants. You can customize the platform based on the crops grown on your farm.',
		    ],
		    [
		        'question' => 'Is there a mobile app for KisanSAT?',
		        'answer' =>
		            'Yes, KisanSAT has a mobile app available for Android device. The app allows you to receive real-time updates and monitor your farm’s health and performance on the go.',
		    ],
		    [
		        'question' => 'How do weather forecasts work?',
		        'answer' =>
		            'KisanSAT’s weather forecasts are powered by satellite data and local weather stations. You will receive a detailed 15-day forecast, including temperature, precipitation, humidity, and wind speed for your farm\'s specific location.',
		    ],
		    [
		        'question' => 'How does pest and disease forecasting work?',
		        'answer' =>
		            'We use satellite imagery and weather data to predict pest and disease outbreaks based on environmental conditions. The system alerts you to potential risks, allowing you to take preventive actions.',
		    ],
		    [
		        'question' => 'How can I get support if I need help?',
		        'answer' =>
		            'Our expert support team is available 24/7. You can reach us via email, phone, or live chat on our website.',
		    ],
		    [
		        'question' => 'What are the pricing plans?',
		        'answer' =>
		            'We offer flexible pricing plans tailored to different farm sizes and requirements. Please visit our Pricing page or contact our sales team for more information.',
		    ],
		];
	@endphp
	<section class="bg-[#F2F7F5] py-14" id="faq">
		<x-faq :faqs="__('messages.faqs')" faqvalues="{{ __('messages.faqvalues') }}" />

	</section>


	{{-- GALLERY SECTION --}}
	{{-- <section class="py-14">
		<div class="container mx-auto px-4 text-center">
			<h2 class="mb-6 text-4xl font-bold text-green-800">{{ __('messages.gallerysection') }}</h2>

			<!-- Swiper Container -->
			<div class="swiper gallerySwiper">
				<div class="swiper-wrapper">
					<!-- Gallery Images -->
					<div class="swiper-slide">
						<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
							src="https://tse2.mm.bing.net/th?id=OIP.KV-H2dyOZNEBt2idEqNk4QHaE5&pid=Api&P=0&h=180" alt="Farm Image">
					</div>
					<div class="swiper-slide">
						<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
							src="https://cdn.wallpapersafari.com/73/39/nk9Lfd.jpg" alt="Farmer Image">
					</div>
					<div class="swiper-slide">
						<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
							src="https://tse2.mm.bing.net/th?id=OIP.KV-H2dyOZNEBt2idEqNk4QHaE5&pid=Api&P=0&h=180" alt="Tractor Image">
					</div>
					<div class="swiper-slide">
						<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
							src="https://cdn.wallpapersafari.com/73/39/nk9Lfd.jpg" alt="Harvest Image">
					</div>
					<div class="swiper-slide">
						<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
							src="https://cdn.wallpapersafari.com/73/39/nk9Lfd.jpg" alt="Cattle Image">
					</div>
				</div>

				<!-- Navigation Buttons -->
				<div class="swiper-button-next text-green-800"></div>
				<div class="swiper-button-prev text-green-800"></div>
			</div>
		</div>

		<script>
			document.addEventListener("DOMContentLoaded", function() {
				new Swiper(".gallerySwiper", {
					slidesPerView: 3, // Show 3 images at a time
					spaceBetween: 20, // Space between images
					loop: true, // Infinite loop
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
					autoplay: {
						delay: 2500, // Auto-slide every 2.5s
						disableOnInteraction: false,
					},
				});
			});
		</script>
	</section> --}}
	<section class="py-14">
		<div class="container mx-auto px-4 text-center max-w-6xl">
			<h2 class="mb-6 text-4xl font-bold text-green-800">{{ __('messages.gallerysection') }}</h2>

			<div class="grid grid-cols-1 gap-4 md:gap-10 md:grid-cols-2">
				<!-- Video 1 -->
				<a class="glightbox1 group relative mx-auto rounded-sm" href="{{ asset('videos/kisansat-gallery-1.mp4') }}">
					<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
						src="{{ asset('images/video-thumbnail-1.png') }}" alt="Farm Video 1">
					<div
						class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 transition-opacity group-hover:bg-opacity-40">
						<i class="fas fa-play-circle text-7xl text-white animate-pulse"></i>
					</div>
				</a>

				<!-- Video 2 -->
				<a class="glightbox1 group relative mx-auto rounded-sm" href="{{ asset('videos/kisansat-gallery-2.mp4') }}">
					<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
						src="{{ asset('images/video-thumbnail-2.png') }}" alt="Farm Video 2">
					<div
						class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 transition-opacity group-hover:bg-opacity-40">
						<i class="fas fa-play-circle text-7xl text-white animate-pulse"></i>
					</div>
				</a>
			</div>
		</div>

		<!-- Scripts -->
		<script src="{{ asset('assets/glightbox.min.js') }}"></script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				GLightbox({
					selector: '.glightbox1',
					type: 'video',
					plyr: {
						config: {
							muted: false,
							hideControls: false,
							resetOnClose: true
						}
					}
				});
			});
		</script>
	</section>


	<section class="py-14">
		<div class="container mx-auto px-4 text-center">
			<a href="{{ url('/contact-us') }}">
				<img src="{{ asset('images/contact.png') }}" alt="contact-us">
			</a>
		</div>
	</section>
</x-guest-layout>


<script>
	var swiper = new Swiper(".mySwiper", {
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
		},
		loop: true, // Enable continuous loop mode
		effect: 'fade', // Use 'fade' effect instead of default 'slide'
		// Optional parameters
		speed: 600, // Transition speed in milliseconds
		autoplay: { // Autoplay the slides
			delay: 3000, // Delay between transitions in milliseconds
		},
		// grabCursor: true, // Change cursor to grab when hovering over the swiper
		// centeredSlides: true, // Center the active slide
		// slidesPerView: 1, // Number of slides per view
		// spaceBetween: 30, // Space between slides in pixels
	});
</script>
