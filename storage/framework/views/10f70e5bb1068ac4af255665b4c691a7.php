<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>



    <div class="container mx-auto">


        
        <div class="pb-3">
            <div class="max-w-10xl mx-auto">
                <div class="white:bg-gray-800 overflow-hidden bg-white font-semibold shadow-sm sm:rounded-lg">
                    <div class="p-6 text-xl text-gray-900 dark:text-gray-800">
                        <?php echo e(__('Key Statistics')); ?>

                    </div>
                </div>
            </div>
        </div>

        
        <div class="mt-5 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Active Farmers: <?php echo e($active_farmer); ?> | InActive Farmers: <?php echo e($inactive_farmer); ?>

                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="flex flex-col items-center justify-center  mr-8" style="position: relative;top: 7px;">
                        <img src="<?php echo e(url('/images/card_1.png')); ?>" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold text-larg"><?php echo e($total_farmer); ?></p>
                        <p class=" text-lg font-semibold">Farmers</p>
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Paid Farms: <?php echo e($paid_farms); ?> | Unpaid Farms: <?php echo e($unpaid_farms); ?>

                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mt-5 flex flex-col items-center justify-center  mr-8">
                        <img src="<?php echo e(url('/images/card_2.png')); ?>" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold"><?php echo e($total_farms); ?></p>
                        <p class="text-lg font-semibold">Farms</p>
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Paid Farms Area: <?php echo e(number_format($paid_area_farms, 1)); ?> | Unpaid Farms Area:
                    <?php echo e(number_format($unpaid_area_farms, 1)); ?>

                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="flex flex-col items-center justify-center  mr-8" style="position: relative;top: 16px;">
                        <img src="<?php echo e(url('/images/card_3.png')); ?>" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold"><?php echo e(number_format($farms_area, 1)); ?></p>
                        <p class=" text-lg font-semibold">Farms Area (Acres)</p>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">


            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Soil Nutrient Analysis: <?php echo e($premium_service_1); ?> | Image-Based Diagnosis:
                    <?php echo e($premium_service_2); ?>

                </span>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-center justify-center mr-8" style="position: relative;top: 6px;">
                        <img src="<?php echo e(url('/images/card_6.png')); ?>" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-15  flex items-center justify-center" style="    align-items: end;">
                        <p class="text-3xl font-extrabold"><?php echo e($total_service); ?></p>
                    </div>
                </div>
                <div class="  flex items-center justify-center">
                    <p class="text-lg font-semibold">Total Service Purchased</p>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Gold Package: <?php echo e($gold_service); ?> | Silver Package:
                    <?php echo e($silver_service); ?> | Basic Package:
                    <?php echo e($basic_service); ?>

                </span>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-center justify-center mr-8" style="position: relative;top: 6px;">
                        <img src="<?php echo e(url('/images/card_7.png')); ?>" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-15  flex items-center justify-center" style="    align-items: end;">
                        <p class="text-3xl font-extrabold"><?php echo e($total_package); ?></p>
                    </div>
                </div>
                <div class="  flex items-center justify-center">
                    <p class="text-lg font-semibold">Total Package Purchased</p>
                </div>
            </div>

            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block text-center">
                    Mobile Payments: <?php echo e(number_format($moblie_rec_amt, 2)); ?> | Admin Payments:
                    <?php echo e(number_format($admin_rec_amt, 2)); ?>

                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="flex flex-col items-center justify-center  mr-8">
                        <img src="<?php echo e(url('/images/card_8.png')); ?>" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold"><?php echo e(number_format($total_rec_amt, 2)); ?></p>
                        <p class="text-lg font-semibold">Received Amount</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>


<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\dashboard.blade.php ENDPATH**/ ?>