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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Add New Crop'))]); ?>
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


        
        

        <?php if($errors->any()): ?>
            <div>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>


        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('contract_farming.crops.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="space-y-6 bg-white p-6 rounded shadow">
                

                <div>
                    <label for="name">Crop Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" class="form-input w-full" required />
                </div>

                <div>
                    <label for="description">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" class="form-textarea w-full" rows="4" required></textarea>
                </div>

                <div class="space-y-2">
                    <label class="font-semibold">Sowing Months <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-2" required>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="January" class="form-checkbox">
                            <span>January</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="February" class="form-checkbox">
                            <span>February</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="March" class="form-checkbox">
                            <span>March</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="April" class="form-checkbox">
                            <span>April</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="May" class="form-checkbox">
                            <span>May</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="June" class="form-checkbox">
                            <span>June</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="July" class="form-checkbox">
                            <span>July</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="August" class="form-checkbox">
                            <span>August</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="September" class="form-checkbox">
                            <span>September</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="October" class="form-checkbox">
                            <span>October</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="November" class="form-checkbox">
                            <span>November</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="December" class="form-checkbox">
                            <span>December</span>
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">
                        Selected: <span id="selected-months"></span>
                    </p>
                </div>

                <script>
                const monthCheckboxes = document.querySelectorAll('input[name="sowing_months[]"]');
                const selectedSpan = document.getElementById('selected-months');

                function updateSelectedMonths() {
                    const selected = Array.from(monthCheckboxes)
                                        .filter(cb => cb.checked)
                                        .map(cb => cb.value);
                    selectedSpan.textContent = selected.join(', ');
                }

                monthCheckboxes.forEach(cb => cb.addEventListener('change', updateSelectedMonths));
                </script>



                <div>
                    <label for="details">Details<span class="text-red-500">*</span></label>
                    <textarea name="details" id="details" class="form-textarea w-full" rows="4" required></textarea>
                </div>

                <div>
                    <label for="pdf_en">English PDF<span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_en" id="pdf_en" class="form-input w-full" accept="application/pdf" required/>
                </div>

                <div>
                    <label for="pdf_hi">Hindi PDF<span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_hi" id="pdf_hi" class="form-input w-full" accept="application/pdf" required/>
                </div>

                <div>
                    <label for="images">Crop Images<span class="text-red-500">*</span></label>
                    <input 
                        type="file" 
                        name="images[]" 
                        id="images" 
                        multiple 
                        accept="image/*"
                        class="form-input w-full" 
                        required
                    />
                    <p class="text-sm text-gray-500 mt-1">You can upload up to 12 images. Only JPG, PNG, GIF.</p>
                    <div id="preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>

    <script>
        const input = document.getElementById('images');
        const preview = document.getElementById('preview-container');
        let allFiles = [];

        input.addEventListener('change', function () {
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
            preview.innerHTML = '';
            const dataTransfer = new DataTransfer();

            allFiles.forEach((file, index) => {
                dataTransfer.items.add(file);

                const reader = new FileReader();
                reader.onload = function (e) {
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
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            input.files = dataTransfer.files;
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\contract_farming\crops\create.blade.php ENDPATH**/ ?>