<header>
	<nav class="bg-white shadow-md" x-data="{ open: false }">
		<!-- Primary Navigation Menu -->
		<div class="mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex h-16 justify-between">
				<div class="shadow-2 flex flex-grow items-center justify-between px-4 py-4 md:px-6 2xl:px-11">
					<div class="flex items-center gap-2 sm:gap-4">
						<button class="z-99999 border-stroke block rounded-sm border bg-white px-2 py-1 shadow-sm"
							@click.stop="sidebarToggle = !sidebarToggle">
							<i class="fa-solid fa-bars"></i>
						</button>
						<a class="block flex-shrink-0 lg:hidden" href="<?php echo e(route('home')); ?>">
							<?php if(!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo))): ?>
								<img class="w-[50px]" src="<?php echo e(asset('storage/' . $setting->application_logo)); ?>" alt="KisanSAT Logo" />
							<?php else: ?>
								<img class="w-[50px]" src="<?php echo e(asset('images/kisansat-logo.png')); ?>" alt="KisanSAT Logo" />
							<?php endif; ?>
						</a>
					</div>
				</div>
				<!-- top Navigation Links -->
				
				

				<!-- Settings Dropdown -->
				<div class="hidden sm:ms-6 sm:flex sm:items-center">
					<?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
						 <?php $__env->slot('trigger', null, []); ?> 
							<button class="btn btn-ghost text-gray-700">
								
								Admin
								<div class="ms-1">
									<i class="fa-solid fa-chevron-down"></i>
								</div>
							</button>
						 <?php $__env->endSlot(); ?>

						 <?php $__env->slot('content', null, []); ?> 
							

							<!-- Authentication -->
							<form method="POST" action="<?php echo e(route('admin.logout')); ?>">
								<?php echo csrf_field(); ?>

								<?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('admin.logout'),'onclick' => 'event.preventDefault();
                                                this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.logout')),'onclick' => 'event.preventDefault();
                                                this.closest(\'form\').submit();']); ?>
									<?php echo e(__('Log Out')); ?>

								 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
							</form>
						 <?php $__env->endSlot(); ?>
					 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
				</div>

				<!-- Hamburger -->
				
			</div>
		</div>

		<!-- Responsive Navigation Menu -->
		
	</nav>

	<!-- Page Heading -->
	<?php if(isset($header)): ?>
		<div class="container mx-auto py-6">
			<?php echo e($header); ?>

		</div>
	<?php endif; ?>

</header>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\header.blade.php ENDPATH**/ ?>