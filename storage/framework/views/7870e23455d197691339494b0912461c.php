<?php if (isset($component)) { $__componentOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc5a09a6cf988cfbb1cdb9a341efb3540 = $attributes; } ?>
<?php $component = App\View\Components\ServiceLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ServiceLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Satellite-Based Rapid Soil Nutrient Analysis','icon' => '🌾','headerImgUrl' => ''.e(asset('images/services_header_1000x500_Soil Nutrient Analysis.png')).' ','description' => 'Gain insights into your soil’s nutrient composition using high-resolution satellite data. Understand deficiencies in real time and make informed decisions on fertilization to maximize crop yield.']); ?>

	<!-- How the Service Works -->
	<div class="mt-8">
		<h2 class="text-2xl font-bold text-emerald-700">How the Service Works</h2>
		<p class="mt-2 leading-relaxed text-gray-700">
			The satellite-based rapid soil nutrient analysis service utilizes advanced remote sensing technology to assess soil
			health and fertility. By analyzing satellite imagery and integrating it with soil data models, the service generates
			an accurate report on key soil nutrients, including:
		</p>
		<ul class="mt-2 list-inside list-disc text-gray-700">
			<li><span class="font-semibold">Nitrogen (N)</span></li>
			<li><span class="font-semibold">Phosphorus (P)</span></li>
			<li><span class="font-semibold">Potassium (K)</span></li>
			<li><span class="font-semibold">Organic Carbon</span></li>
		</ul>
		<p class="mt-2 leading-relaxed text-gray-700">
			AI-driven algorithms process satellite data to evaluate soil composition and nutrient availability. The results are
			compiled into a detailed soil health report, which can be accessed by farmers for better crop management.
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
<?php $component->withAttributes(['icon' => 'fas fa-bolt','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
				<p><span class="font-semibold">Quick and Efficient:</span> Provides rapid and accurate soil nutrient analysis
					without physical sampling.</p>
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
<?php $component->withAttributes(['icon' => 'fas fa-money-bill-wave','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
				<p><span class="font-semibold">Cost-Effective:</span> More affordable than traditional lab-based soil testing.</p>
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
				<p><span class="font-semibold">Precision Farming:</span> Enables precise fertilizer application, reducing waste and
					increasing crop yields.</p>
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
				<p><span class="font-semibold">Sustainable Agriculture:</span> Prevents overuse of fertilizers and promotes balanced
					nutrient application.</p>
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
<?php $component->withAttributes(['icon' => 'fas fa-globe','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
				<p><span class="font-semibold">Remote Accessibility:</span> Farmers can receive reports from anywhere, minimizing
					field visits.</p>
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
<?php $component->withAttributes(['icon' => 'fas fa-chart-bar','iconSize' => 'text-lg','bgSize' => 'w-12 h-12']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
				<p><span class="font-semibold">Improved Decision-Making:</span> Enhances the ability of farmers to make data-driven
					soil and crop management decisions.</p>
			</div>
		</div>
	</div>

	<!-- Procedure to Use -->
	<div class="mt-8">
		<h2 class="text-2xl font-bold text-emerald-700">Procedure to Use</h2>
		<div class="mt-4 space-y-4">
			<div class="flex items-start space-x-3">
				<span class="font-bold text-emerald-600">1.</span>
				<p><span class="font-semibold">Registration:</span> Farmers register via the KisanSAT mobile application.</p>
			</div>
			<div class="flex items-start space-x-3">
				<span class="font-bold text-emerald-600">2.</span>
				<p><span class="font-semibold">Farm Location Input:</span> Users provide geographical coordinates or select farmland
					on a digital map.</p>
			</div>
			<div class="flex items-start space-x-3">
				<span class="font-bold text-emerald-600">3.</span>
				<p><span class="font-semibold">Data Processing:</span> Satellite technology analyzes soil nutrient levels using
					real-time and historical satellite imagery.</p>
			</div>
			<div class="flex items-start space-x-3">
				<span class="font-bold text-emerald-600">4.</span>
				<p><span class="font-semibold">Report Generation:</span> A comprehensive soil health report is generated, including
					nutrient levels and recommendations.</p>
			</div>
			<div class="flex items-start space-x-3">
				<span class="font-bold text-emerald-600">5.</span>
				<p><span class="font-semibold">Accessing the Report:</span> Farmers receive the report via the KisanSAT app
					dashboard.</p>
			</div>
			<div class="flex items-start space-x-3">
				<span class="font-bold text-emerald-600">6.</span>
				<p><span class="font-semibold">Implementation:</span> Farmers use recommendations to optimize fertilizer usage and
					soil management practices.</p>
			</div>
		</div>
	</div>

	
	<br />
	<br />
	<hr />
	<div class="bg-gray-100 py-12">
		<h2 class="text-center text-2xl font-bold text-emerald-700">Explore Farm Equipments</h2>
		<p class="mb-6 mt-2 text-center text-gray-600">
			Browse top-rated farming equipment tailored for your agricultural needs
			<br />
			Click below to explore the entire collection
		</p>

		<div class="flex flex-wrap justify-center gap-6 px-6">
			<!-- Farm Equipment -->
			<div class="card min-w-60 rounded-lg bg-white p-4 text-center shadow-md">
				<i class="fa-solid fa-tractor text-4xl text-green-600"></i>
				<h3 class="mt-4 text-xl font-semibold">Farm Equipments</h3>
				<a class="btn btn-success btn-sm mt-3 text-white" href="https://www.ekisanzone.com/product_list.php?cat_id=1"
					target="_blank">
					Buy Now
				</a>
			</div>

			<!-- Seeds -->
			<div class="card min-w-60 rounded-lg bg-white p-4 text-center shadow-md">
				<i class="fa-solid fa-seedling text-4xl text-green-600"></i>
				<h3 class="mt-4 text-xl font-semibold">Seeds</h3>
				<a class="btn btn-success btn-sm mt-3 text-white" href="https://www.ekisanzone.com/product_list.php?cat_id=2"
					target="_blank">
					Buy Now
				</a>
			</div>

			<!-- Fertilizers -->
			<div class="card min-w-60 rounded-lg bg-white p-4 text-center shadow-md">
				<i class="fa-solid fa-leaf text-4xl text-green-600"></i>
				<h3 class="mt-4 text-xl font-semibold">Fertilizers</h3>
				<a class="btn btn-success btn-sm mt-3 text-white" href="https://www.ekisanzone.com/product_list.php?cat_id=3"
					target="_blank">
					Buy Now
				</a>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\services\soil-nutrient-analysis.blade.php ENDPATH**/ ?>