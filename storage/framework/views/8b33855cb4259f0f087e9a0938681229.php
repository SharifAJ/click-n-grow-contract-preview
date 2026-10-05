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
    <div class="container mt-3 mb-20 max-w-5xl px-4 sm:px-6 lg:px-8">
        <!-- Page Title -->
        <div class="rounded-lg bg-gradient-to-r from-green-200 via-emerald-100 to-emerald-200 p-6 text-center shadow-lg">
            <h1 class="mt-4 text-2xl font-extrabold sm:text-4xl"><?php echo e(__('messages.aboutus_page_title')); ?></h1>
            <p class="mt-2 text-base sm:text-lg"><?php echo e(__('messages.aboutus_page_sub_title')); ?></p>
        </div>

        <div class="flex flex-col items-center gap-12 lg:flex-row mt-10">
            <!-- Text Content -->
            <div class="space-y-6 lg:w-1/2" data-aos="fade-right">
                <h2 class="text-2xl font-semibold text-primary sm:text-3xl"><?php echo e(__('messages.about_title')); ?></h2>
                <p class="text-base font-medium text-gray-700 sm:text-lg">
                    <?php echo e(__('messages.about_description')); ?>

                </p>
                
                <p class="text-sm text-gray-600 sm:text-base">
                    <?php echo e($setting['about_us_' . app()->getLocale()] ?? __('messages.default_about_us')); ?>

                </p>
            </div>

            <!-- Image -->
            <div class="flex justify-center lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                <img class="w-full max-w-xs sm:max-w-md rounded-lg shadow-xl"
                    src="<?php echo e(asset('images/about-us-1000x667.webp')); ?>" alt="Farmer using KisanSAT">
            </div>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\about.blade.php ENDPATH**/ ?>