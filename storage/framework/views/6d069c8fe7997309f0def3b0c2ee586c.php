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
    
    <?php if (isset($component)) { $__componentOriginala9460c3f03249ecfefb27342dfe2f2cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9460c3f03249ecfefb27342dfe2f2cc = $attributes; } ?>
<?php $component = App\View\Components\HeaderTitle::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\HeaderTitle::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Package Master Show'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9460c3f03249ecfefb27342dfe2f2cc)): ?>
<?php $attributes = $__attributesOriginala9460c3f03249ecfefb27342dfe2f2cc; ?>
<?php unset($__attributesOriginala9460c3f03249ecfefb27342dfe2f2cc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9460c3f03249ecfefb27342dfe2f2cc)): ?>
<?php $component = $__componentOriginala9460c3f03249ecfefb27342dfe2f2cc; ?>
<?php unset($__componentOriginala9460c3f03249ecfefb27342dfe2f2cc); ?>
<?php endif; ?>





    <div class=" mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Package Master</h4>
                <a href="<?php echo e(route('servicemaster.index')); ?>" class="btn btn-neutral text-white">
                    Back
                </a>
            </div>

            <div class="overflow-x-auto">

                <div class="w-1/2 p-5">
                    <table class="table w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Package Name</th>
                                <td class="border border-gray-300"><?php echo e($packageMaster_data->name); ?></td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Description</th>
                                <td class="border border-gray-300"><?php echo e($packageMaster_data->description); ?></td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Total Services</th>
                                <td class="border border-gray-300">

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                        <?php $__currentLoopData = $service_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label
                                                class="flex items-center space-x-2 bg-gray-100   p-2 rounded-lg shadow-md cursor-pointer  ">

                                                <span class="text-black-900 "><?php echo e($service->name); ?></span>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <!-- Box for Total Services Count -->
                                    <div class="mt-4 flex justify-left">
                                        <div
                                            class="border border-gray-500 rounded-lg   w-10 text-center bg-gray-100 shadow-md">
                                            <p class="text-2xl font-bold text-gray-700">
                                                <?php echo e($service_data->count() ?? 'N/A'); ?>

                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Subscription Duration</th>
                                
                                <td class="border border-gray-300"> <?php echo e(implode(', ', $packageMaster_data->duration)); ?>

                                </td>

                            </tr>
                            <tr>
                                <th class="border border-gray-300">Amount/Acre(Rs)</th>
                                <td class="border border-gray-300"><?php echo e($packageMaster_data->amount ?? 'N/A'); ?> </td>
                            </tr>
                            

                        </tbody>
                    </table>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\setting\package\view.blade.php ENDPATH**/ ?>