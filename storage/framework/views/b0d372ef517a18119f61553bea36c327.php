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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Add Farm Details'))]); ?>
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
        <form method="POST" action="<?php echo e(route('addfarm.update', $farm_data->id)); ?>" class="kisansat_form">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Farmer Details</h4>
                </div>

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="w-1/2 p-5">

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Farmer Name<span class="text-red-500">*</span></span>
                        </label>
                        <select name="user_id" id="selec_farmer" class="select select-bordered w-full" required>
                            <option value="" disabled <?php echo e(old('user_id') ? '' : 'selected'); ?>>Select Farmer
                            </option>
                            <?php $__currentLoopData = $farmer_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($f_data->id); ?>"
                                    <?php echo e($farm_data->user_id == $f_data->id ? 'selected' : ''); ?>>
                                    <?php echo e($f_data->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['user_id'];
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
                            <span class="label-text">Farm Name <span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="<?php echo e(old('name', $farm_data->name)); ?>"
                            placeholder="Name of the farm" class="input input-bordered w-full" required>
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
                            <span class="label-text">Coordinate<span class="text-red-500">*</span></span>
                        </label>

                        <textarea name="coordinates" id="" placeholder="Enter Coordinates" rows="4"
                            class="textarea textarea-bordered w-full" required>
                            <?php echo e(old('coordinates', json_encode($farm_data['geo_json']['geometry']['coordinates']))); ?>

                        </textarea>

                        <?php $__errorArgs = ['coordinates'];
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
                            <span class="label-text">Croptype<span class="text-red-500">*</span></span>
                        </label>
                        <select name="croptype" id="croptype_id" class="select select-bordered w-full" required>
                            <option value="" disabled <?php echo e(old('croptype') ? '' : 'selected'); ?>>Select Croptype
                            </option>
                            <?php $__currentLoopData = $crop_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($data->crop_name); ?>"
                                    <?php echo e($farm_data->croptype == $data->crop_name ? 'selected' : ''); ?>>
                                    <?php echo e($data->crop_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['croptype'];
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
                            <span class="label-text">Category<span class="text-red-500">*</span></span>
                        </label>
                        <select name="category" class="select select-bordered w-full" required>
                            <option value="" disabled>Select Category</option>
                            <option value="farm" <?php echo e($farm_data->category == 'farm' ? 'selected' : ''); ?>>Farm</option>
                            <option value="garden" <?php echo e($farm_data->category == 'garden' ? 'selected' : ''); ?>>Garden
                            </option>
                            <option value="polyhouse" <?php echo e($farm_data->category == 'polyhouse' ? 'selected' : ''); ?>>
                                Polyhouse
                            </option>
                            <option value="tank" <?php echo e($farm_data->category == 'tank' ? 'selected' : ''); ?>>Tank</option>
                        </select>
                        <?php $__errorArgs = ['category'];
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

                    <?php
                        $date = date('d-m-Y'); // Correct format for validation
                    ?>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Sowing Date<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="sowingdate"
                            value="<?php echo e(old('sowingdate', \Carbon\Carbon::parse($farm_data->sowingdate)->format('d-m-Y'))); ?>"
                            class="input input-bordered w-full" required placeholder="dd-mm-yyyy">
                        <?php $__errorArgs = ['sowingdate'];
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
                            <span class="label-text">Crop Variety</span>
                        </label>
                        <input type="text" name="crop_variety"
                            value="<?php echo e(old('crop_variety', $farm_data->crop_variety)); ?>"
                            placeholder="Enter Crop Variety" class="input input-bordered w-full">
                        <?php $__errorArgs = ['crop_variety'];
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
                    <a href="<?php echo e(route('addfarm.index')); ?>" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            $('#selec_farmer').select2();
            $('#croptype_id').select2();
        });
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farm\edit.blade.php ENDPATH**/ ?>