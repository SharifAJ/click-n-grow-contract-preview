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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Farm Details'))]); ?>
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
            

            <div class="overflow-x-auto">

                <div class="w-1/2 p-5">
                    <table class="table   w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Farm ID</th>
                                <td class="border border-gray-300"><?php echo e($farm_data->farm_id); ?></td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Farm Name</th>
                                <td class="border border-gray-300"><?php echo e($farm_data->farm_name); ?></td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Farmer Name</th>
                                <td class="border border-gray-300"><?php echo e($farm_data->user_name); ?></td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Farm Area</th>
                                <td class="border border-gray-300"><?php echo e(floor($farm_data->area * 10) / 10); ?> Acre</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Coordinates</th>
                                <td class="border border-gray-300">
                                    <?php echo e(isset($farm_data['geo_json']['geometry']['coordinates'])
                                        ? json_encode($farm_data['geo_json']['geometry']['coordinates'])
                                        : 'N/A'); ?>

                                </td>

                            </tr>
                            <tr>
                                <th class="border border-gray-300">Crop Type</th>
                                <td class="border border-gray-300"><?php echo e(ucfirst($farm_data->croptype)); ?></td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Crop Variety</th>
                                <td class="border border-gray-300"><?php echo e($farm_data->crop_variety ?? 'N/A'); ?></td>
                            </tr>
                            
                            <tr>
                                <th class="border border-gray-300">Sowing Date</th>
                                <td class="border border-gray-300">
                                    <?php echo e(date('d-M-Y', strtotime($farm_data->sowingdate ?? 'N/A'))); ?></td>
                            </tr>
                            
                            
                            <tr>
                                <th class="border border-gray-300">Status</th>
                                <?php if($farm_data->farm_deleted_at == null): ?>
                                    <td class="border border-gray-300">Active</td>
                                <?php else: ?>
                                    <td class="border border-gray-300">Inactive</td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                    <a href="<?php echo e(route('addfarm.index')); ?>" class="btn btn-neutral mt-4 text-white">
                        Back
                    </a>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farm\view.blade.php ENDPATH**/ ?>