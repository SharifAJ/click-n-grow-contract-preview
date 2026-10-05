<?php if (isset($component)) { $__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $attributes; } ?>
<?php $component = App\View\Components\ServiceLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ServiceLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.crop_calendar_title')).'','icon' => '📅','headerImgUrl' => ''.e(asset('/images/services_header2_1000x500.png')).'','description' => ''.e(__('messages.crop_calendar_description')).'']); ?>

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.crop_calendar_how_title')); ?></h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            <?php echo e(__('messages.crop_calendar_how_para1')); ?>

        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            <?php echo e(__('messages.crop_calendar_how_para2')); ?>

        </p>
    </div>

    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.benefits_title')); ?></h2>
        <div class="mt-4 grid gap-x-8 gap-y-6 md:grid-cols-2">
            <div class="flex items-start space-x-3">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fas fa-hourglass-start','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.benefit_1_title')); ?></span>
                    <?php echo e(__('messages.benefit_1_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fas fa-tint','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.benefit_2_title')); ?></span>
                    <?php echo e(__('messages.benefit_2_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fas fa-seedling','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.benefit_3_title')); ?></span>
                    <?php echo e(__('messages.benefit_3_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fas fa-coins','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.benefit_4_title')); ?></span>
                    <?php echo e(__('messages.benefit_4_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fas fa-cloud-sun-rain','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.benefit_5_title')); ?></span>
                    <?php echo e(__('messages.benefit_5_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fas fa-recycle','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.benefit_6_title')); ?></span>
                    <?php echo e(__('messages.benefit_6_desc')); ?></p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.procedure_title')); ?></h2>
        <div class="mt-4 space-y-4">
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">1.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.procedure_step1_title')); ?></span>
                    <?php echo e(__('messages.procedure_step1_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">2.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.procedure_step2_title')); ?></span>
                    <?php echo e(__('messages.procedure_step2_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">3.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.procedure_step3_title')); ?></span>
                    <?php echo e(__('messages.procedure_step3_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">4.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.procedure_step4_title')); ?></span>
                    <?php echo e(__('messages.procedure_step4_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">5.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.procedure_step5_title')); ?></span>
                    <?php echo e(__('messages.procedure_step5_desc')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">6.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.procedure_step6_title')); ?></span>
                    <?php echo e(__('messages.procedure_step6_desc')); ?></p>
            </div>
        </div>
    </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540)): ?>
<?php $attributes = $__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540; ?>
<?php unset($__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540)): ?>
<?php $component = $__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540; ?>
<?php unset($__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540); ?>
<?php endif; ?>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\services\crop-calendar.blade.php ENDPATH**/ ?>