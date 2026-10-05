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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Edit Package Master Details'))]); ?>
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

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class=" mt-5">
        <form method="POST" action="<?php echo e(route('packagemaster.update', $package->id)); ?>" class="kisansat_form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Edit Package Master Details</h4>
                </div>

                <div class="w-1/2 p-5">
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Package Name<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="<?php echo e(old('name', $package->name)); ?>"
                            placeholder="Enter Package Name" class="input input-bordered w-full" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input type="text" name="description" value="<?php echo e(old('description', $package->description)); ?>"
                            placeholder="Enter Description" class="input input-bordered w-full">
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text font-semibold text-lg">Select Services<span
                                    class="text-red-500">*</span></span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <?php $__currentLoopData = $service_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label
                                    class="flex items-center space-x-2 bg-gray-100   p-2 rounded-lg shadow-md cursor-pointer   ">
                                    <input type="checkbox" name="services[]" value="<?php echo e($item->id); ?>"
                                        class="checkbox checkbox-primary"
                                        <?php echo e(in_array($item->id, $selected_services) ? 'checked' : ''); ?>>
                                    <span class="text-black-900 "><?php echo e($item->name); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['services'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Subscription Duration<span class="text-red-500">*</span></span>
                        </label>
                        <select name="duration" class="select select-bordered w-full" required>
                            <option value="" disabled
                                <?php echo e(old('duration', $package->duration) ? '' : 'selected'); ?>>
                                Select Time Duration</option>
                            <option value="12" <?php echo e(old('duration', $package->duration) == '12' ? 'selected' : ''); ?>>
                                12 Months</option>
                            <option value="6" <?php echo e(old('duration', $package->duration) == '6' ? 'selected' : ''); ?>>6
                                Months</option>
                            <option value="1" <?php echo e(old('duration', $package->duration) == '1' ? 'selected' : ''); ?>>1
                                Month</option>
                            <option value="-1" <?php echo e(old('duration', $package->duration) == '-1' ? 'selected' : ''); ?>>
                                Lifetime</option>

                        </select>
                        <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Amount <span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="amount" id="amount"
                            value="<?php echo e(old('amount', $package->amount)); ?>" placeholder="Enter Amount"
                            class="input input-bordered w-full" required pattern="^\d+(\.\d{0,2})?$"
                            oninput="validateDecimal(this)">
                        <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="<?php echo e(route('servicemaster.index')); ?>" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>

    
    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let checkboxes = document.querySelectorAll('input[name="services[]"]:checked');
            if (checkboxes.length === 0) {
                event.preventDefault();
                alert("Please select at least one service.");
            }
        });
    </script>
    <script>
        function validateDecimal(input) {
            input.value = input.value.replace(/[^0-9.]/g, '') // Allow only numbers and dot
                .replace(/(\..*)\./g, '$1') // Prevent multiple dots
                .replace(/^0+(?=\d)/, '') // Prevent leading zeros
                .match(/^\d*(\.\d{0,2})?/g)?.[0] || ''; // Restrict to 2 decimals
        }
    </script>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\setting\package\edit.blade.php ENDPATH**/ ?>