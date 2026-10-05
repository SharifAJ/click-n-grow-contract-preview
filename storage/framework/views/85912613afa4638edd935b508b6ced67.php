<?php if (isset($component)) { $__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $attributes; } ?>
<?php $component = App\View\Components\ServiceLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ServiceLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.mandi_rates_title')).'','icon' => '📊','headerImgUrl' => ''.e(asset('images/services_header_1000x500_mandi rates.png')).'','description' => ''.e(__('messages.mandi_rates_description')).'']); ?>

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.mandi_rates_how_it_works_title')); ?></h2>
        <p class="text-gray-700 mt-2 leading-relaxed">
            <?php echo e(__('messages.mandi_rates_how_it_works_para1')); ?>

        </p>
    </div>


    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.mandi_rates_benefits_title')); ?></h2>
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 mt-4">
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
<?php $component->withAttributes(['icon' => 'fas fa-search','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.transparency')); ?>:</span>
                    <?php echo e(__('messages.transparency_text')); ?></p>
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
<?php $component->withAttributes(['icon' => 'fas fa-chart-line','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.market_awareness')); ?>:</span>
                    <?php echo e(__('messages.market_awareness_text')); ?></p>
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
<?php $component->withAttributes(['icon' => 'fas fa-wallet','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.better_bargaining')); ?>:</span>
                    <?php echo e(__('messages.better_bargaining_text')); ?></p>
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
<?php $component->withAttributes(['icon' => 'fas fa-chart-bar','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.profit_maximization')); ?>:</span>
                    <?php echo e(__('messages.profit_maximization_text')); ?></p>
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
<?php $component->withAttributes(['icon' => 'fas fa-shield-alt','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.reduced_exploitation')); ?>:</span>
                    <?php echo e(__('messages.reduced_exploitation_text')); ?></p>
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
<?php $component->withAttributes(['icon' => 'fas fa-chart-pie','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p><span class="font-semibold"><?php echo e(__('messages.economic_growth')); ?>:</span>
                    <?php echo e(__('messages.economic_growth_text')); ?></p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.procedure_to_use')); ?></h2>
        <div class="space-y-4 mt-4">
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">1.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.access_service')); ?>:</span>
                    <?php echo e(__('messages.access_service_text')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">2.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.select_commodity_location')); ?>:</span>
                    <?php echo e(__('messages.select_commodity_location_text')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">3.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.analyze_market_trends')); ?>:</span>
                    <?php echo e(__('messages.analyze_market_trends_text')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">4.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.make_informed_decisions')); ?>:</span>
                    <?php echo e(__('messages.make_informed_decisions_text')); ?></p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">5.</span>
                <p><span class="font-semibold"><?php echo e(__('messages.stay_updated')); ?>:</span>
                    <?php echo e(__('messages.stay_updated_text')); ?></p>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\services\mandi-rates.blade.php ENDPATH**/ ?>