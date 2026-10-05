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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Contract Farming Crops'))]); ?>
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
        <div class="flex justify-end mb-4">
            <a href="<?php echo e(route('contract_farming.crops.create')); ?>"
               class="bg-green-700 text-white border-green-600 hover:bg-green-600 hover:border-green-700 font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                Add New Crop
            </a>
        </div>

        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">
            <div class="w-full p-7 bg-white">
                <table class="table" id="crops_Table">
                    <thead class="text-primary-content">
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Details</th>
                            <th>Sowing Months</th>
                            <th>English PDF</th>
                            <th>Hindi PDF</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $crops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td class="text-2xl"><?php echo $crop->icon; ?></td>
                                <td><?php echo e($crop->name); ?></td>
                                <td><?php echo e(Str::limit($crop->description, 50)); ?></td>
                                <td><?php echo e(Str::limit($crop->details, 50)); ?></td>
                                <td>
                                    <?php if(!empty($crop->sowing_months)): ?>
                                        <?php echo e(implode(', ', is_array($crop->sowing_months) ? $crop->sowing_months : json_decode($crop->sowing_months, true) ?? [])); ?>

                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($crop->pdf_en): ?>
                                        <a href="<?php echo e(asset('storage/' . $crop->pdf_en)); ?>" target="_blank" class="text-blue-500 underline">View</a>
                                    <?php else: ?> N/A <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($crop->pdf_hi): ?>
                                        <a href="<?php echo e(asset('storage/' . $crop->pdf_hi)); ?>" target="_blank" class="text-blue-500 underline">View</a>
                                    <?php else: ?> N/A <?php endif; ?>
                                </td>
                                <td class="flex">
                                    <a href="<?php echo e(route('contract_farming.crops.show', $crop->id)); ?>" class="text-blue-500 underline"><i class="fas fa-eye text-2xl px-2"></i></a>
                                    <a href="<?php echo e(route('contract_farming.crops.edit', $crop->id)); ?>" class="text-green-500 underline"><i class="fas fa-edit text-2xl px-2"></i></a>
                                    <!-- Delete -->
                                    <form action="<?php echo e(route('contract_farming.crops.destroy', $crop->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="text-red-500 underline bg-transparent p-0 m-0 border-0 cursor-pointer">
                                            <i type="button" class="fa-solid fa-trash text-2xl px-2  delete-button"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                new DataTable("#crops_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    fixedColumns: { left: 1, right: 1 },
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    responsive: true,
                    layout: {
                        topStart: {
                            buttons: [
                                { extend: "pageLength" },
                                
                            ]
                        }
                    }
                });
            });
        </script>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\contract_farming\crops\index.blade.php ENDPATH**/ ?>