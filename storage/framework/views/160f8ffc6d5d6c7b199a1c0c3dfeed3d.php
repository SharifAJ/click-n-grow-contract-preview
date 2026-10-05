<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
	<link href="<?php echo e(asset('assets/glightbox.min.css')); ?>" rel="stylesheet">

	<!-- Hero Section -->
	<section class="swiper mySwiper h-[600px] w-full md:h-[85vh]">
		<div class="swiper-wrapper h-[600px] md:h-[85vh]">

			<!-- Slide 1: Video Background -->
			<div class="swiper-slide relative flex h-full items-center justify-center bg-white px-6 text-center text-[18px]"
				x-data="{ videoLoaded: false }">

				
				<picture x-show="!videoLoaded">
					<!-- Mobile image (loaded only when max-width ≤ 768px) -->
					<source srcset="<?php echo e(asset('images/hero_placeholder_img2_mobile_version.webp')); ?>" media="(max-width: 768px)">

					<!-- Default / Desktop image -->
					<img class="absolute inset-0 h-full w-full object-cover" src="<?php echo e(asset('images/hero_placeholder_img2.webp')); ?>"
						alt="Loading Video" fetchpriority="high" decoding="async">
				</picture>


				<video class="absolute left-0 top-0 -z-10 h-full w-full object-cover" x-ref="video" x-init="$refs.video.playbackRate = 0.7;
	$refs.video.onloadeddata = () => videoLoaded = true" muted
					autoplay loop playsinline>

					<!-- Mobile MP4 -->
					<source src="<?php echo e(asset('videos/hero_video_bg_10s_mobile_version.mp4')); ?>" type="video/mp4"
						media="(max-width: 768px)">

					<!-- Desktop MP4 -->
					<source src="<?php echo e(asset('videos/hero_video_bg_10s.mp4')); ?>" type="video/mp4">

					Your browser does not support the video tag.
				</video>



				<div class="container relative z-10 flex h-full items-center justify-center">
					<div class="hero-content flex-col rounded-lg text-center text-white">
						<h1 class="text-4xl font-extrabold [text-shadow:_0_10px_16px_rgb(0_0_0_/_0.8)] md:text-4xl lg:text-5xl">
							<?php echo e(__('messages.hero_title')); ?>

						</h1>
					</div>
				</div>
			</div>

			<div class="swiper-slide bg-top-left flex bg-cover px-6 md:bg-center"
				style="background-image: url('<?php echo e(asset('images/hero_bg.jpg')); ?>');">
				<div
					class="container mx-auto flex flex-col items-center justify-start gap-10 ps-2 pt-10 md:flex-row md:justify-center md:gap-2 md:ps-10 md:pt-0">
					<!-- Left Side: Text Content -->
					<div
						class="animate-fade-in-left flex flex-col items-center gap-2 space-y-4 text-center md:basis-[700px] md:items-start md:text-left">
						<h1 class="text-4xl font-extrabold text-white md:text-5xl lg:text-6xl xl:text-6xl">
							<?php echo e(__('messages.hero_title_1')); ?> <br> <?php echo e(__('messages.hero_title_2')); ?>

						</h1>
						<p class="text-md font-bold text-white md:text-[1.4rem]">
							<?php echo e(__('messages.hero_description')); ?>

						</p>
						<!-- Better button implementation -->
						<a
							class="btn-white text-md btn justify-start px-6 font-bold text-emerald-900 transition-all duration-300 hover:scale-105"
							href="<?php echo e(env('ANDROID_APP_LINK')); ?>" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-google-play pr-1 text-lg"></i>
							<?php echo e(__('messages.download_now')); ?>

						</a>

					</div>

					<!-- Right Side: Mobile Screenshot -->
					<div class="animate-fade-in-right w-full" data-aos="zoom-in" data-aos-duration="1000">
						<img class="mx-auto" src="<?php echo e(asset('images/app_screenshots4x.png')); ?>" alt="KisanSAT Mobile App Preview"
							loading="lazy" />
					</div>
				</div>
			</div>

			

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

	
	<section class="relative bg-[#F2F7F5]">
		<div
			class="container mx-auto flex flex-col items-center justify-center gap-4 px-6 py-10 md:flex-row md:gap-20 md:px-20 md:py-20">
			<!-- Left Column: Text Content -->
			<div class="max-w-md space-y-4 text-center md:text-left">
				<h2 class="text-2xl font-bold text-gray-900 md:text-3xl"><?php echo e(__('messages.get_started_title')); ?></h2>
				<p class="text-base text-gray-700 md:text-lg"><?php echo e(__('messages.get_started_desc')); ?></p>
				<a
					class="btn btn-primary inline-block rounded-md px-6 py-2 text-sm uppercase text-white md:px-10 md:py-3 md:text-lg"
					href="<?php echo e(env('ANDROID_APP_LINK')); ?>">
					<i class="fas fa-download mr-2"></i> <?php echo e(__('messages.download_button')); ?>

				</a>
			</div>

			<!-- Right Column: QR Code & Play Store Button -->
			<div class="mt-8 flex flex-col items-center space-y-4 md:mt-0">
				<img class="w-24 md:w-32" src="<?php echo e(asset('images/qr-code.jpg')); ?>" alt="QR Code">
				<span class="text-xs text-gray-600 md:text-sm"><?php echo e(__('messages.scan_text')); ?></span>
			</div>
		</div>
	</section>



	<!-- Introduction Section -->
	<section class="py-14" id="about">
		<div class="container mx-auto px-4">
			<div class="flex flex-col items-center gap-2 md:gap-10 lg:flex-row lg:gap-16">
				<!-- Text Content -->
				<div class="lg:w-1/2" data-aos="fade-right">
					<h2 class="mb-4 text-3xl font-bold text-primary md:text-4xl"><?php echo e(__('messages.about_title')); ?></h2>
					<p class="text-lg font-semibold text-gray-800 md:text-xl">
						<?php echo e(__('messages.about_description')); ?>

					</p>
					<br>
					

					<p class="text-base text-gray-700 md:text-lg">
						<?php echo e($setting['about_us_' . app()->getLocale()] ?? __('messages.default_about_us')); ?>

					</p>

				</div>

				<!-- Image -->
				<div class="mt-8 w-full lg:mt-0 lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
					<img class="w-full rounded-lg object-cover shadow-lg" src="<?php echo e(asset('images/about-us-1000x667.webp')); ?>"
						alt="Farmer using KisanSAT">
				</div>
			</div>
		</div>
	</section>

	
	<section class="relative bg-[#F2F7F5] py-14" id="services">
		<?php if (isset($component)) { $__componentOriginal4321e56a33236dade94f1aa1235e0f9f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4321e56a33236dade94f1aa1235e0f9f = $attributes; } ?>
<?php $component = App\View\Components\SectionDividerTopWaves::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-divider-top-waves'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SectionDividerTopWaves::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4321e56a33236dade94f1aa1235e0f9f)): ?>
<?php $attributes = $__attributesOriginal4321e56a33236dade94f1aa1235e0f9f; ?>
<?php unset($__attributesOriginal4321e56a33236dade94f1aa1235e0f9f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4321e56a33236dade94f1aa1235e0f9f)): ?>
<?php $component = $__componentOriginal4321e56a33236dade94f1aa1235e0f9f; ?>
<?php unset($__componentOriginal4321e56a33236dade94f1aa1235e0f9f); ?>
<?php endif; ?>

		<div class="container px-4">
			<h2 class="mb-10 text-center text-4xl font-bold"><?php echo e(__('messages.our_services')); ?></h2>
			<div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
				<!-- Satellite-based Soil Nutrient Analysis -->
				<!-- Soil Nutrient Analysis -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_1_title')).'','icon' => 'fas fa-seedling','description' => ''.e(__('messages.service_1_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'soil-nutrient-analysis')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Pest and Disease Forecasting -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_2_title')).'','icon' => 'fas fa-bug','description' => ''.e(__('messages.service_2_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'pest-and-disease-forewarning')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Crop Health Monitoring -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_3_title')).'','icon' => 'fas fa-leaf','description' => ''.e(__('messages.service_3_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'crop-health-analysis')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Image-Based Diagnosis -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_4_title')).'','icon' => 'fas fa-camera','description' => ''.e(__('messages.service_4_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'image-based-diagnosis')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Weather Forecast -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_5_title')).'','icon' => 'fas fa-cloud-sun','description' => ''.e(__('messages.service_5_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'weather-forecasting')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Soil Moisture Estimation -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_6_title')).'','icon' => 'fas fa-tint','description' => ''.e(__('messages.service_6_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'soil-moisture-estimation')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Crop Calendar -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_7_title')).'','icon' => 'fas fa-calendar-alt','description' => ''.e(__('messages.service_7_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'crop-calendar')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Land Area Mapping -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_8_title')).'','icon' => 'fas fa-map-marked-alt','description' => ''.e(__('messages.service_8_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'land-area-mapping')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Irrigation Requirement Estimation -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_9_title')).'','icon' => 'fas fa-water','description' => ''.e(__('messages.service_9_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'optimal-irrigation')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

				<!-- Mandi Rates -->
				<?php if (isset($component)) { $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07 = $attributes; } ?>
<?php $component = App\View\Components\FeatureCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FeatureCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.service_10_title')).'','icon' => 'fas fa-clock','description' => ''.e(__('messages.service_10_description')).'','button_name' => ''.e(__('messages.our_services_button')).'','url' => ''.e(route('services.show', 'mandi-rates')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $attributes = $__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__attributesOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07)): ?>
<?php $component = $__componentOriginal6660e6d9c57bcffaf37d76b59d296f07; ?>
<?php unset($__componentOriginal6660e6d9c57bcffaf37d76b59d296f07); ?>
<?php endif; ?>

			</div>
		</div>
		<?php if (isset($component)) { $__componentOriginal23afec3f8039f51e656e80068f07eddc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23afec3f8039f51e656e80068f07eddc = $attributes; } ?>
<?php $component = App\View\Components\SectionDividerBottomWaves::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-divider-bottom-waves'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SectionDividerBottomWaves::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23afec3f8039f51e656e80068f07eddc)): ?>
<?php $attributes = $__attributesOriginal23afec3f8039f51e656e80068f07eddc; ?>
<?php unset($__attributesOriginal23afec3f8039f51e656e80068f07eddc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23afec3f8039f51e656e80068f07eddc)): ?>
<?php $component = $__componentOriginal23afec3f8039f51e656e80068f07eddc; ?>
<?php unset($__componentOriginal23afec3f8039f51e656e80068f07eddc); ?>
<?php endif; ?>

	</section>
	
	 <?php if (isset($component)) { $__componentOriginala3c1d951ce64ffbbe4289a42ad7c6d3d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3c1d951ce64ffbbe4289a42ad7c6d3d = $attributes; } ?>
<?php $component = App\View\Components\Cta::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Cta::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3c1d951ce64ffbbe4289a42ad7c6d3d)): ?>
<?php $attributes = $__attributesOriginala3c1d951ce64ffbbe4289a42ad7c6d3d; ?>
<?php unset($__attributesOriginala3c1d951ce64ffbbe4289a42ad7c6d3d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3c1d951ce64ffbbe4289a42ad7c6d3d)): ?>
<?php $component = $__componentOriginala3c1d951ce64ffbbe4289a42ad7c6d3d; ?>
<?php unset($__componentOriginala3c1d951ce64ffbbe4289a42ad7c6d3d); ?>
<?php endif; ?> 

	

	<section class="py-14">
		<div class="container mx-auto px-4">
			<!-- Section Title -->
			<h2 class="mb-12 text-center text-4xl font-bold text-primary">
				<?php echo e(__('messages.unlocking_benefits_title')); ?>

			</h2>

			<!-- Cards Grid -->
			<div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
				<?php if (isset($component)) { $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $attributes; } ?>
<?php $component = App\View\Components\BenefitCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('benefit-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BenefitCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e(__('messages.benefit_1_value')).'','afterValue' => ''.e(__('messages.benefit_1_afterValue')).'','beforeValue' => ''.e(__('messages.benefit_1_beforeValue')).'','backgroundImage' => ''.e(asset('images/water-saving.jpg')).'','description' => ''.e(__('messages.benefit_1_description')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $attributes = $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $component = $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>

				<?php if (isset($component)) { $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $attributes; } ?>
<?php $component = App\View\Components\BenefitCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('benefit-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BenefitCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e(__('messages.benefit_2_value')).'','afterValue' => ''.e(__('messages.benefit_2_afterValue')).'','beforeValue' => ''.e(__('messages.benefit_2_beforeValue')).'','backgroundImage' => ''.e(asset('images/input-saving.jpg')).'','description' => ''.e(__('messages.benefit_2_description')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $attributes = $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $component = $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>

				<?php if (isset($component)) { $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $attributes; } ?>
<?php $component = App\View\Components\BenefitCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('benefit-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BenefitCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e(__('messages.benefit_3_value')).'','afterValue' => ''.e(__('messages.benefit_3_afterValue')).'','beforeValue' => ''.e(__('messages.benefit_3_beforeValue')).'','backgroundImage' => ''.e(asset('images/farmer-happy.jpg')).'','description' => ''.e(__('messages.benefit_3_description')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $attributes = $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $component = $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>

				<?php if (isset($component)) { $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b = $attributes; } ?>
<?php $component = App\View\Components\BenefitCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('benefit-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BenefitCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e(__('messages.benefit_4_value')).'','afterValue' => ''.e(__('messages.benefit_4_afterValue')).'','beforeValue' => ''.e(__('messages.benefit_4_beforeValue')).'','backgroundImage' => ''.e(asset('images/yeild.jpg')).'','description' => ''.e(__('messages.benefit_4_description')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $attributes = $__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__attributesOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b)): ?>
<?php $component = $__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b; ?>
<?php unset($__componentOriginal2cfbfd2063f58daf5b1b02eed5c7234b); ?>
<?php endif; ?>
			</div>
		</div>
	</section>





	
	<?php
		$faqs = [
		    [
		        'question' => 'What is KisanSAT?',
		        'answer' =>
		            'KisanSAT is a satellite-based platform that offers a suite of precision farming services, including soil nutrient analysis, pest and disease forecasting, weather updates, crop health monitoring, and more. We provide actionable insights for farmers to optimize their resources and boost crop yield.',
		    ],
		    [
		        'question' => 'How do I access KisanSAT’s services?',
		        'answer' =>
		            '1) Download our app from the <u><a href="' .
		            env('ANDROID_APP_LINK') .
		            '"  target="_blank"><strong>Google Play Store</strong></a></u>.<br>
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
	?>
	<section class="bg-[#F2F7F5] py-14" id="faq">
		<?php if (isset($component)) { $__componentOriginala2b47d17e991601600cc7e057526ae7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2b47d17e991601600cc7e057526ae7c = $attributes; } ?>
<?php $component = App\View\Components\Faq::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('faq'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Faq::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['faqs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.faqs')),'faqvalues' => ''.e(__('messages.faqvalues')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2b47d17e991601600cc7e057526ae7c)): ?>
<?php $attributes = $__attributesOriginala2b47d17e991601600cc7e057526ae7c; ?>
<?php unset($__attributesOriginala2b47d17e991601600cc7e057526ae7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2b47d17e991601600cc7e057526ae7c)): ?>
<?php $component = $__componentOriginala2b47d17e991601600cc7e057526ae7c; ?>
<?php unset($__componentOriginala2b47d17e991601600cc7e057526ae7c); ?>
<?php endif; ?>

	</section>


	
	
	<section class="py-14">
		<div class="container mx-auto px-4 text-center max-w-6xl">
			<h2 class="mb-6 text-4xl font-bold text-green-800"><?php echo e(__('messages.gallerysection')); ?></h2>

			<div class="grid grid-cols-1 gap-4 md:gap-10 md:grid-cols-2">
				<!-- Video 1 -->
				<a class="glightbox1 group relative mx-auto rounded-sm" href="<?php echo e(asset('videos/kisansat-gallery-1.mp4')); ?>">
					<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
						src="<?php echo e(asset('images/video-thumbnail-1.png')); ?>" alt="Farm Video 1">
					<div
						class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 transition-opacity group-hover:bg-opacity-40">
						<i class="fas fa-play-circle text-7xl text-white animate-pulse"></i>
					</div>
				</a>

				<!-- Video 2 -->
				<a class="glightbox1 group relative mx-auto rounded-sm" href="<?php echo e(asset('videos/kisansat-gallery-2.mp4')); ?>">
					<img class="h-40 w-full rounded-lg object-cover shadow-lg sm:h-60 md:h-72 lg:h-80"
						src="<?php echo e(asset('images/video-thumbnail-2.png')); ?>" alt="Farm Video 2">
					<div
						class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 transition-opacity group-hover:bg-opacity-40">
						<i class="fas fa-play-circle text-7xl text-white animate-pulse"></i>
					</div>
				</a>
			</div>
		</div>

		<!-- Scripts -->
		<script src="<?php echo e(asset('assets/glightbox.min.js')); ?>"></script>
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
			<a href="<?php echo e(url('/contact-us')); ?>">
				<img src="<?php echo e(asset('images/contact.png')); ?>" alt="contact-us">
			</a>
		</div>
	</section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>


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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\home.blade.php ENDPATH**/ ?>