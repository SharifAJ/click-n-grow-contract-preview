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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Crop Details'))]); ?>
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

    <div class="mt-5">
    <div class="rounded border bg-white shadow">
        <div class="p-6 space-y-4">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <tbody>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Icon</th>
                        <td class="border p-2 text-left text-2xl"><?php echo e($crop->icon); ?></td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Name</th>
                        <td class="border p-2 text-left"><?php echo e($crop->name); ?></td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Description</th>
                        <td class="border p-2 text-left"><?php echo e($crop->description); ?></td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Details</th>
                        <td class="border p-2 text-left"><?php echo e($crop->details ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Sowing Months</th>
                        <td class="border p-2 text-left">
                            <?php echo e(implode(', ', is_array($crop->sowing_months) ? $crop->sowing_months : json_decode($crop->sowing_months, true) ?? []) ?: 'N/A'); ?>

                        </td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">English PDF</th>
                        <td class="border p-2 text-left">
                            <?php if($crop->pdf_en): ?>
                                <a href="<?php echo e(asset('storage/' . $crop->pdf_en)); ?>" class="text-blue-600 underline" target="_blank">View English PDF</a>
                            <?php else: ?> 
                                N/A 
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Hindi PDF</th>
                        <td class="border p-2 text-left">
                            <?php if($crop->pdf_hi): ?>
                                <a href="<?php echo e(asset('storage/' . $crop->pdf_hi)); ?>" class="text-blue-600 underline" target="_blank">View Hindi PDF</a>
                            <?php else: ?> 
                                N/A 
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            
            <div>
                <h4 class="font-semibold mb-2">Crop Images</h4>
                <div class="flex gap-4 flex-wrap">
                    <?php if($crop->images): ?>
                        <?php $__currentLoopData = json_decode($crop->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('storage/' . $image)); ?>" class="w-40 h-32 object-cover rounded border" />
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No images available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <a href="<?php echo e(route('contract_farming.crops.index')); ?>" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 mt-4 inline-block">
                Back
            </a>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\contract_farming\crops\show.blade.php ENDPATH**/ ?>