<aside
    class="fixed left-0 top-0 z-[9999] flex h-screen w-72 flex-col overflow-y-hidden bg-gray-700 transition-all duration-300 ease-in-out lg:static"
    :class="sidebarToggle ? 'translate-x-0 w-72' : '-translate-x-full w-0 lg:w-0'"> 
    <!-- SIDEBAR HEADER -->
    <div class="mb-4 flex items-center justify-between gap-2 px-4 py-4 sm:px-6 lg:px-8">
        <a href="<?php echo e(route('dashboard')); ?>">
            <?php if(!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo))): ?>
                <img class="w-20" src="<?php echo e(asset('storage/' . $setting->application_logo)); ?>" alt="KisanSAT Logo">
            <?php else: ?>
                <img class="w-20" src="<?php echo e(asset('images/kisansat-logo.png')); ?>" alt="KisanSAT Logo">
            <?php endif; ?>
        </a>

        <button class="block px-2 py-1 shadow-sm lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <i class="fa-solid fa-arrow-left text-2xl text-white"></i>
        </button>
    </div>
    <!-- Menu -->
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <ul>
            <?php if (isset($component)) { $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-link','data' => ['href' => route('dashboard'),'active' => request()->routeIs('dashboard'),'icon' => 'fa-solid fa-tachometer-alt','text' => 'Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard')),'icon' => 'fa-solid fa-tachometer-alt','text' => 'Dashboard']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $attributes = $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $component = $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
            


                <?php if (isset($component)) { $__componentOriginal6c24846fb4315b0871c25bf1694da017 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c24846fb4315b0871c25bf1694da017 = $attributes; } ?>
<?php $component = App\View\Components\SidebarSubmenuLink::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-submenu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SidebarSubmenuLink::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Contract Farming','icon' => 'fa-solid fa-seedling']); ?>
                   <?php if (isset($component)) { $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-link','data' => ['href' => route('contract_farming.crops.index'),'active' => request()->routeIs('contract_farming.crops.index'),'icon' => 'fa-solid fa-seedling','text' => 'Crop details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('contract_farming.crops.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('contract_farming.crops.index')),'icon' => 'fa-solid fa-seedling','text' => 'Crop details']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $attributes = $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $component = $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
                   <?php if (isset($component)) { $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-link','data' => ['href' => route('contract_farming.enquiry.index'),'active' => request()->routeIs('contract_farming.enquiry.index'),'icon' => 'fa-solid fa-plus','text' => 'Enquiry Form details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('contract_farming.enquiry.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('contract_farming.enquiry.index')),'icon' => 'fa-solid fa-plus','text' => 'Enquiry Form details']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $attributes = $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $component = $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c24846fb4315b0871c25bf1694da017)): ?>
<?php $attributes = $__attributesOriginal6c24846fb4315b0871c25bf1694da017; ?>
<?php unset($__attributesOriginal6c24846fb4315b0871c25bf1694da017); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c24846fb4315b0871c25bf1694da017)): ?>
<?php $component = $__componentOriginal6c24846fb4315b0871c25bf1694da017; ?>
<?php unset($__componentOriginal6c24846fb4315b0871c25bf1694da017); ?>
<?php endif; ?>


            

            <!-- Collapsible Submenu -->
            <?php if (isset($component)) { $__componentOriginal6c24846fb4315b0871c25bf1694da017 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c24846fb4315b0871c25bf1694da017 = $attributes; } ?>
<?php $component = App\View\Components\SidebarSubmenuLink::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-submenu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SidebarSubmenuLink::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Settings','icon' => 'fa-solid fa-cogs']); ?>
                
                <?php if (isset($component)) { $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-link','data' => ['href' => route('setting.index'),'active' => request()->routeIs('setting.index'),'icon' => 'fa-solid fa-cog','text' => 'General Setting']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('setting.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('setting.index')),'icon' => 'fa-solid fa-cog','text' => 'General Setting']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $attributes = $__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__attributesOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300)): ?>
<?php $component = $__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300; ?>
<?php unset($__componentOriginal3d3185cbc95d2b4d3b41182ae7d7a300); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c24846fb4315b0871c25bf1694da017)): ?>
<?php $attributes = $__attributesOriginal6c24846fb4315b0871c25bf1694da017; ?>
<?php unset($__attributesOriginal6c24846fb4315b0871c25bf1694da017); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c24846fb4315b0871c25bf1694da017)): ?>
<?php $component = $__componentOriginal6c24846fb4315b0871c25bf1694da017; ?>
<?php unset($__componentOriginal6c24846fb4315b0871c25bf1694da017); ?>
<?php endif; ?>




            
        </ul>
    </div>
</aside>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\components\sidebar.blade.php ENDPATH**/ ?>