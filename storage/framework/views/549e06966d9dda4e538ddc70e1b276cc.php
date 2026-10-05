<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'KisanSat Services',
    'description' =>
        'KisanSAT is a satellite-based agriculture advisory service for issues relating to agriculture and a crop management concept that is more beneficial for increased crop yield.',
    'icon' => '',
    'headerImgUrl' => asset('/images/services_header2_1000x500.png'),
    'headerImgAlt' => 'KisanSat Services Hero Image',
]));

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

foreach (array_filter(([
    'title' => 'KisanSat Services',
    'description' =>
        'KisanSAT is a satellite-based agriculture advisory service for issues relating to agriculture and a crop management concept that is more beneficial for increased crop yield.',
    'icon' => '',
    'headerImgUrl' => asset('/images/services_header2_1000x500.png'),
    'headerImgAlt' => 'KisanSat Services Hero Image',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

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

    

    <div class="z-10 overflow-hidden bg-gradient-to-br from-green-100 via-transparent to-transparent">
        <div class="relative mx-auto flex h-auto w-full flex-col items-center sm:h-80 md:h-96 md:flex-row">

            <!-- Left Side (Text) -->
            <div
                class="w-full ps-6 pt-5 text-center text-black sm:ps-10 md:w-1/2 md:pt-0 md:text-left lg:pe-10 lg:ps-20">
                <h1 class="mb-4 text-xl font-extrabold md:text-4xl"><?php echo e($title); ?></h1>
                <p class="mt-2 text-base sm:text-xl"><?php echo e($description); ?></p>
            </div>
            <!-- Right Side (Image) -->
            <div class="mask-image mt-5 w-full md:mt-0 md:w-2/3">
                <img class="h-48 w-full object-cover md:h-full" src="<?php echo e($headerImgUrl); ?>" alt="<?php echo e($headerImgAlt); ?>">
            </div>
        </div>
    </div>
    <!-- CSS for Masking Effect -->
    <style>
        .mask-image {
            height: 100%;
            -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 0.5) 90%, rgba(0, 0, 0, 0) 100%);
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 0.5) 90%, rgba(0, 0, 0, 0) 100%);
        }
    </style>


    <div class="container z-10 mt-10 w-full max-w-5xl bg-white px-4 sm:px-6 lg:px-20">
        

        
        


        <!-- Slot for page-specific content -->
        <div class="mt-6">
            <?php echo e($slot); ?>

        </div>

        <!-- CTA Button -->
        

        <div class="my-16 text-center">
            <a class="text-sm text-blue-600 hover:underline sm:text-base"
                href="<?php echo e(route('home')); ?>/#services"><?php echo e(__('messages.all_Services_button')); ?></a>
        </div>
    </div>
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
	const swiper = new Swiper(".productsSwiper", {
		loop: true,
		slidesPerView: 2,
		spaceBetween: 20,
		autoplay: {
			delay: 1,
			disableOnInteraction: false,
		},
		speed: 4000, // smooth continuous scroll
		grabCursor: true,
		freeMode: true,
		freeModeMomentum: false,
		breakpoints: {
			640: {
				slidesPerView: 2
			},
			768: {
				slidesPerView: 3
			},
			1024: {
				slidesPerView: 4
			},
		},
	});
</script>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\service-layout.blade.php ENDPATH**/ ?>