<?php if (isset($component)) { $__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $attributes; } ?>
<?php $component = App\View\Components\ServiceLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ServiceLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.pest_service_title')).'','icon' => '🐛','headerImgUrl' => ''.e(asset('images/services_header_1000x500_Pest and Disease Forewarning.png')).'','description' => ''.e(__('messages.pest_service_description')).'']); ?>

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.how_service_works')); ?></h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            <?php echo e(__('messages.pest_service_paragraph1')); ?>

        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            <?php echo e(__('messages.pest_service_paragraph2')); ?>

        </p>
    </div>

	<!-- Benefits of the Service -->
	<div class="mt-8">
		<h2 class="text-2xl font-bold text-emerald-700">Benefits of the Service</h2>
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
				<p><span class="font-semibold">Early Warning System:</span> Provides timely alerts about potential pest and disease
					outbreaks, enabling farmers to take preventive measures.</p>
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
				<p><span class="font-semibold">Crop Protection:</span> Helps in reducing crop loss due to pest attacks and diseases,
					ensuring a healthier harvest.</p>
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
				<p><span class="font-semibold">Cost Savings:</span> Minimizes excessive use of pesticides and fertilizers by
					recommending precise and effective control measures.</p>
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
<?php $component->withAttributes(['icon' => 'fas fa-leaf','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
				<p><span class="font-semibold">Sustainability:</span> Encourages environmentally friendly farming by reducing the
					overuse of chemicals, preserving soil health and biodiversity.</p>
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
<?php $component->withAttributes(['icon' => 'fas fa-chart-line','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
				<p><span class="font-semibold">Improved Productivity:</span> Enhances farmers’ preparation, leading to better crop
					management and increased agricultural output.</p>
			</div>
		</div>
	</div>


    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.benefits_of_service')); ?></h2>
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
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_benefit_1_title')); ?></span>
                    <?php echo e(__('messages.pest_benefit_1_text')); ?>

                </p>
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
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_benefit_2_title')); ?></span>
                    <?php echo e(__('messages.pest_benefit_2_text')); ?>

                </p>
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
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_benefit_3_title')); ?></span>
                    <?php echo e(__('messages.pest_benefit_3_text')); ?>

                </p>
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
<?php $component->withAttributes(['icon' => 'fas fa-leaf','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_benefit_4_title')); ?></span>
                    <?php echo e(__('messages.pest_benefit_4_text')); ?>

                </p>
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
<?php $component->withAttributes(['icon' => 'fas fa-chart-line','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_benefit_5_title')); ?></span>
                    <?php echo e(__('messages.pest_benefit_5_text')); ?>

                </p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700"><?php echo e(__('messages.procedure_to_use_service')); ?></h2>
        <div class="mt-4 space-y-4">
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">1.</span>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_procedure_1_title')); ?></span>
                    <?php echo e(__('messages.pest_procedure_1_text')); ?>

                </p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">2.</span>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_procedure_2_title')); ?></span>
                    <?php echo e(__('messages.pest_procedure_2_text')); ?>

                </p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">3.</span>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_procedure_3_title')); ?></span>
                    <?php echo e(__('messages.pest_procedure_3_text')); ?>

                </p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">4.</span>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_procedure_4_title')); ?></span>
                    <?php echo e(__('messages.pest_procedure_4_text')); ?>

                </p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">5.</span>
                <p>
                    <span class="font-semibold"><?php echo e(__('messages.pest_procedure_5_title')); ?></span>
                    <?php echo e(__('messages.pest_procedure_5_text')); ?>

                </p>
            </div>
        </div>
    </div>


	

	<br />
	<br />
	<hr />
	<div class="bg-gray-100 py-12">
		<h2 class="text-center text-2xl font-bold text-emerald-700">Protect Your Crops</h2>
		<p class="mb-6 mt-2 text-center text-gray-600">
			Get the best pesticides, lures, and traps to safeguard your farm.
			<br />
			Click below to explore the entire collection.
		</p>

		<div class="flex flex-wrap justify-center gap-6 px-6">
			<!-- Pesticides -->
			<div class="card min-w-60 rounded-lg bg-white p-4 text-center shadow-md">
				<i class="fa-solid fa-spray-can text-4xl text-green-600"></i>
				<h3 class="mt-4 text-xl font-semibold">Pesticides</h3>
				<a class="btn btn-success btn-sm mt-3 text-white" href="https://www.ekisanzone.com/product_list.php?cat_id=7"
					target="_blank">Buy Now</a>
			</div>

			<!-- Lures & Traps -->
			<div class="card min-w-60 rounded-lg bg-white p-4 text-center shadow-md">
				<i class="fa-solid fa-spider text-4xl text-green-600"></i>
				<h3 class="mt-4 text-xl font-semibold">Lures & Traps</h3>
				<a class="btn btn-success btn-sm mt-3 text-white" href="https://www.ekisanzone.com/product_list.php?cat_id=33"
					target="_blank">Buy Now</a>
			</div>
		</div>
	</div>
	<hr />



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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\services\pest-and-disease-forewarning.blade.php ENDPATH**/ ?>