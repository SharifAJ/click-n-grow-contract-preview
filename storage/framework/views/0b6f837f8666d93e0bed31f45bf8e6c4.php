<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['contract_var' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['contract_var' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<!DOCTYPE html>
<html data-theme="emerald" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
	<link href="<?php echo e(asset('images/hero_placeholder_img2.webp')); ?>" rel="preload" as="image">
	<link href="<?php echo e(asset('images/hero_placeholder_img2_mobile_version.webp')); ?>" rel="preload" as="image"
		media="(max-width: 768px)">


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="description"
		content="KisanSAT offers satellite-based agriculture advisory services in India—featuring soil nutrient analysis, crop health monitoring, pest forewarning, irrigation planning, and 15-day weather forecasts. Boost yield, save water, and improve produce quality with expert agri insights.">
	<meta name="keywords"
		content="KisanSAT, Agriculture, Farming, Technology, Services, Kisan, Farmers, Crop Health, Soil Analysis, Weather Forecasting">
	<meta name="author" content="KisanSAT">

	<?php if(!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo))): ?>
		<link type="image/x-icon" href="<?php echo e(asset('storage/' . $setting->application_logo)); ?>" rel="icon">
	<?php else: ?>
		<link type="image/x-icon" href="<?php echo e(asset('images/kisansat-logo.png')); ?>" rel="icon">
	<?php endif; ?>

	
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Cantora+One&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
		rel="stylesheet">
	<!-- Check if the local Font Awesome file exists -->
	<?php if(file_exists(public_path('css/font-awesome.min.css'))): ?>
		<link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
	<?php else: ?>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<?php endif; ?>

	
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

	<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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

					<?php
						$isContract = ($contract_var ?? null) === 'contract_page';
					?>

					<a class="text-xl font-bold" href="<?php echo e(route('home')); ?>">
						<?php if($isContract): ?>
							<img class="w-20" src="<?php echo e(asset('images/Click N Grow Final Logo.jpg')); ?>" alt="Contract Logo">
						<?php elseif(!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo))): ?>
							<img class="w-20" src="<?php echo e(asset('storage/' . $setting->application_logo)); ?>" alt="KisanSAT Logo">
						<?php else: ?>
							<img class="w-20" src="<?php echo e(asset('images/kisansat-logo.png')); ?>" alt="KisanSAT Logo">
						<?php endif; ?>
					</a>

				</div>
				<div class="navbar-center hidden lg:flex">
					<!-- Centered Menu -->
					<ul class="menu menu-horizontal space-x-4 px-4">
						<li><a href="<?php echo e(route('contract')); ?>"><?php echo e(__('messages.contract')); ?></a></li>

						
						<li><a href="#"><?php echo e(__('messages.contact_us')); ?></a></li>

						<li class="group dropdown dropdown-hover">
							<label class="flex cursor-pointer items-center space-x-2" tabindex="0">
								<span><?php echo e(__('messages.language')); ?></span>
								<i class="fas fa-chevron-down transition-transform duration-500 group-hover:text-emerald-600"></i>
							</label>
							<ul class="menu dropdown-content z-50 w-max rounded-[2px] bg-base-100 shadow-md">
								<li class="px-3">
									<a class="<?php echo e(session('applocale') == 'en' ? 'font-bold text-emerald-600' : ''); ?>"
										href="<?php echo e(route('change.language', 'en')); ?>">
										English
									</a>
								</li>
								<li class="px-3">
									<a class="<?php echo e(session('applocale') == 'hi' ? 'font-bold text-emerald-600' : ''); ?>"
										href="<?php echo e(route('change.language', 'hi')); ?>">
										हिन्दी
									</a>
								</li>
								<li class="px-3">
									<a class="<?php echo e(session('applocale') == 'mr' ? 'font-bold text-emerald-600' : ''); ?>"
										href="<?php echo e(route('change.language', 'mr')); ?>">
										मराठी
									</a>
								</li>
							</ul>
						</li>
					</ul>

				</div>
				<div class="navbar-end">
					<!-- Login/Register on the Right -->
					
				</div>
			</div>
			
			<main>
				<?php echo e($slot); ?>

			</main>

			<?php if(!isset($contract_var) || $contract_var !== 'contract_page'): ?>
				<footer class="relative bg-gradient-to-b from-slate-700 via-slate-800 to-slate-900 py-10 text-white">
					<div class="absolute inset-0 bg-cover bg-center opacity-70"
						style="background-image: url('<?php echo e(asset('images/hero_placeholder_img2.webp')); ?>');">
					</div>

					<div class="container relative z-10 border-gray-400 px-6 pt-6">
						<div class="mx-auto px-6 text-center">
							<h2 class="text-2xl font-bold sm:text-3xl md:text-4xl" data-aos="fade-up">
								<?php echo e(__('messages.footer.title')); ?>

							</h2>
							<p class="mt-2 text-sm opacity-90 sm:text-base md:text-lg" data-aos="fade-up" data-aos-delay="200">
								<?php echo e(__('messages.footer.desc')); ?>

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
									<?php echo e(__('messages.footer.contact')); ?>

								</h4>
								<p class="mt-4 flex items-center text-sm sm:text-base">
									<i class="fas fa-map-marker-alt pr-2"></i> <?php echo e($setting->company_address); ?>

								</p>
								<p class="mt-4 text-sm sm:text-base">
									<i class="fas fa-phone-alt fa-flip-horizontal pr-1"></i> <span
										class="font-semibold"><?php echo e($setting->phone_number); ?></span>
								</p>
								<p class="text-sm sm:text-base">
									<i class="fas fa-phone-alt fa-flip-horizontal pr-1"></i> <span class="font-semibold">+91-77750-08660</span>
								</p>
								<p class="mt-4 text-sm sm:text-base">
									<i class="fas fa-envelope pr-1"></i>
									<a class="font-semibold hover:underline" href="mailto:<?php echo e($setting->company_email); ?>">
										<?php echo e($setting->company_email); ?>

									</a>
								</p>
							</div>

							<div>
								<h4 class="pb-2 text-lg font-bold uppercase sm:text-xl">
									<?php echo e(__('messages.footer.quick_links')); ?></h4>
								<ul class="mt-4 space-y-2 text-sm sm:text-base">
									<li><a class="transition hover:underline" href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.footer.home')); ?></a>
									</li>
									<li><a class="transition hover:underline" href="<?php echo e(route('about')); ?>"><?php echo e(__('messages.footer.about')); ?></a>
									</li>
									<li><a class="transition hover:underline"
											href="<?php echo e(route('home')); ?>/#services"><?php echo e(__('messages.footer.services')); ?></a>
									</li>
									<li><a class="transition hover:underline"
											href="<?php echo e(route('home')); ?>/#faq"><?php echo e(__('messages.footer.faq')); ?></a></li>
									<li><a class="transition hover:underline"
											href="<?php echo e(route('contact-us')); ?>"><?php echo e(__('messages.footer.contact_us')); ?></a>
									</li>
								</ul>
							</div>

							<div>
								<h4 class="pb-2 text-lg font-bold uppercase sm:text-xl">
									<?php echo e(__('messages.footer.services')); ?></h4>
								<ul class="mt-4 space-y-2 text-sm sm:text-base">

									<?php $__currentLoopData = __('messages.footer.service_list'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<a class="transition hover:underline" href="<?php echo e(route('services.show', ['service' => $slug])); ?>">
												<?php echo e($name); ?>

											</a>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<li class="pt-3">
										<a class="transition hover:underline" href="<?php echo e(route('home')); ?>/#services">
											<i class="fas fa-search"></i> <?php echo e(__('messages.footer.see_all')); ?>

										</a>
									</li>
								</ul>
							</div>
							<!-- Logo & Social Links -->
							<div class="flex flex-col items-center text-center md:text-left">
								<div class="inline-block w-fit rounded-lg bg-white p-3 shadow-md">
									<img class="w-24 sm:w-32 md:w-40" src="<?php echo e(asset('storage/' . $setting->application_logo)); ?>"
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
							<p><?php echo e(__('messages.footer.copyright')); ?> |
								<a class="hover:underline" href="<?php echo e(route('refund-policy')); ?>"><?php echo e(__('messages.footer.privacy')); ?></a> |
								<a class="hover:underline" href="<?php echo e(route('terms-and-conditions')); ?>"><?php echo e(__('messages.footer.terms')); ?></a>
							</p>
						</div>
					</div>
				</footer>
			<?php endif; ?>



		</div>
		<?php if (isset($component)) { $__componentOriginal999305a4650b25c991fd3f20c80f0824 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal999305a4650b25c991fd3f20c80f0824 = $attributes; } ?>
<?php $component = App\View\Components\WhatsAppButton::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('whats-app-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\WhatsAppButton::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['phoneNumber' => '9096248660']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal999305a4650b25c991fd3f20c80f0824)): ?>
<?php $attributes = $__attributesOriginal999305a4650b25c991fd3f20c80f0824; ?>
<?php unset($__attributesOriginal999305a4650b25c991fd3f20c80f0824); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal999305a4650b25c991fd3f20c80f0824)): ?>
<?php $component = $__componentOriginal999305a4650b25c991fd3f20c80f0824; ?>
<?php unset($__componentOriginal999305a4650b25c991fd3f20c80f0824); ?>
<?php endif; ?>

		<div class="drawer-side z-50">
			<label class="drawer-overlay" for="custom-mobile-menu-drawer" aria-label="close sidebar"></label>
			<ul class="menu min-h-full w-80 bg-base-100 p-4">
				<li><a href="<?php echo e(route('contract')); ?>"><b><?php echo e(__('messages.contract')); ?></b></a></li>
				
				<li><a href="#"><b><?php echo e(__('messages.footer.contact_us')); ?></b></a></li>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\layouts\guest.blade.php ENDPATH**/ ?>