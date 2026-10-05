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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Edit Crop'))]); ?>
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
        <form action="<?php echo e(route('contract_farming.crops.update', $crop->id)); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="space-y-6 bg-white p-6 rounded shadow">
                <!-- Crop Icon -->
                

                <!-- Crop Name -->
                <div>
                    <label for="name">Crop Name<span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" class="form-input w-full"
                        value="<?php echo e(old('name', $crop->name)); ?>" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description">Description<span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" class="form-textarea w-full" rows="4" required><?php echo e(old('description', $crop->description)); ?></textarea>
                </div>

                <!-- Details -->
                <div>
                    <label for="details">Details<span class="text-red-500">*</span></label>
                    <textarea name="details" id="details" class="form-textarea w-full" rows="4"><?php echo e(old('details', $crop->details)); ?></textarea>
                </div>

                <?php
                    $months = [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December',
                    ];
                    $selected_months = $crop->sowing_months ?? [];
                ?>

                <!-- Sowing Months -->
                <div class="space-y-2">
                    <label class="font-semibold">Sowing Months<span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-2">
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="inline-flex items-center space-x-2">
                                <input type="checkbox" name="sowing_months[]" value="<?php echo e($month); ?> "
                                    <?php echo e(in_array($month, $selected_months) ? 'checked' : ''); ?>>
                                <span><?php echo e($month); ?></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- PDF Uploads -->
                <div>
                    <label for="pdf_en">English PDF <span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_en" id="pdf_en" class="form-input w-full"
                        accept="application/pdf" onchange="validatePDF(this)">
                    <?php if($crop->pdf_en): ?>
                        <p class="text-sm text-gray-600 mt-1">
                            Current:
                            <a href="<?php echo e(asset('storage/' . $crop->pdf_en)); ?>" target="_blank"
                                class="underline text-blue-600">View</a>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="pdf_hi">Hindi PDF <span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_hi" id="pdf_hi" class="form-input w-full"
                        accept="application/pdf" onchange="validatePDF(this)">
                    <?php if($crop->pdf_hi): ?>
                        <p class="text-sm text-gray-600 mt-1">
                            Current:
                            <a href="<?php echo e(asset('storage/' . $crop->pdf_hi)); ?>" target="_blank"
                                class="underline text-blue-600">View</a>
                        </p>
                    <?php endif; ?>
                </div>

                <script>
                    function validatePDF(input) {
                        const file = input.files[0];
                        if (file && file.type !== 'application/pdf') {
                            alert('Please select a valid PDF file.');
                            input.value = ''; // Clear the invalid file
                        }
                    }
                </script>

                <!-- Existing Images -->
                <div>
                    <label for="images">Crop Images (optional)</label>
                    <input type="file" name="images[]" id="images" class="form-input w-full" multiple accept="image/*">

                    <?php if($crop->images): ?>
                        <p class="text-sm text-gray-600 mt-2">Existing Images:</p>
                        <div class="flex flex-wrap gap-2 mt-1" id="existing-images">
                            <?php $__currentLoopData = json_decode($crop->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative w-24 h-24 border rounded overflow-hidden">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" class="object-cover w-full h-full">
                                    <button type="button" class="absolute top-0 right-0 bg-red-600 text-white text-xs w-6 h-6 rounded-full"
                                            onclick="removeExistingImage(this, '<?php echo e(asset('storage/' . $img)); ?>')">
                                        ×
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- New Image Previews -->
                <div id="preview-container" class="mt-4 flex flex-wrap gap-4"></div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        // Handle new image selection
        const input = document.getElementById('images');
        const previewContainer = document.getElementById('preview-container');
        let allFiles = [];

        input.addEventListener('change', function() {
            const selectedFiles = Array.from(this.files);
            const combinedFiles = [...allFiles, ...selectedFiles];

            if (combinedFiles.length > 12) {
                alert('You can only upload up to 12 images.');
                return;
            }

            allFiles = combinedFiles;
            updatePreviews();
        });

        function updatePreviews() {
            previewContainer.innerHTML = '';
            allFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative w-24 h-24 border rounded overflow-hidden';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.className = 'absolute top-0 right-0 bg-red-600 text-white w-5 h-5 text-xs rounded-full';
                    removeBtn.onclick = () => {
                        allFiles.splice(index, 1);
                        updatePreviews();
                    };

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    previewContainer.appendChild(div);
                };

                reader.readAsDataURL(file);
            });
        }

        function removeExistingImage(button, imgUrl) {
            // Implement logic to remove image from the preview and also update image list (or handle delete)
            console.log(`Remove image with URL: ${imgUrl}`);
            button.closest('div').remove();
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\contract_farming\crops\edit.blade.php ENDPATH**/ ?>