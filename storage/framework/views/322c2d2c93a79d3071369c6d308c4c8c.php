<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mb-20 mt-3 max-w-5xl px-4 sm:px-6 lg:px-8">
        <?php if (isset($component)) { $__componentOriginal522a3c8aadb4ccbcc229d59265244da1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal522a3c8aadb4ccbcc229d59265244da1 = $attributes; } ?>
<?php $component = App\View\Components\PageHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PageHeader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.getin_touch_title')).'','subTitle' => ''.e(__('messages.getin_touch_subtitle')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal522a3c8aadb4ccbcc229d59265244da1)): ?>
<?php $attributes = $__attributesOriginal522a3c8aadb4ccbcc229d59265244da1; ?>
<?php unset($__attributesOriginal522a3c8aadb4ccbcc229d59265244da1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal522a3c8aadb4ccbcc229d59265244da1)): ?>
<?php $component = $__componentOriginal522a3c8aadb4ccbcc229d59265244da1; ?>
<?php unset($__componentOriginal522a3c8aadb4ccbcc229d59265244da1); ?>
<?php endif; ?>
        <!-- Contact Grid -->
        <div class="mt-14 grid gap-6 sm:gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Address Card -->
            <div class="rounded-xl bg-white p-6 shadow-md sm:py-8 sm:ps-8 sm:pe-4">
                <div
                    class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 sm:mb-6 sm:h-16 sm:w-16">
                    <i class="fas fa-map-marker-alt text-xl text-emerald-600 sm:text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 sm:text-2xl"><?php echo e(__('messages.getin_Office')); ?></h3>
                <address class="mt-3 text-base not-italic text-gray-600 sm:mt-4">
                    

                    <?php echo e($setting->company_address); ?>

                </address>
            </div>

            <!-- Contact Card -->
            <div class="rounded-xl bg-white p-6 shadow-md sm:p-8">
                <div
                    class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 sm:mb-6 sm:h-16 sm:w-16">
                    <i class="fas fa-phone-alt fa-flip-horizontal text-xl text-emerald-600 sm:text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 sm:text-2xl"><?php echo e(__('messages.getin_PhoneNumbers')); ?></h3>
                <div class="mt-4 space-y-2 sm:mt-6 sm:space-y-3">
                    <p class="text-base text-gray-600 hover:text-emerald-600 sm:text-lg">
                        <a class="flex items-center gap-2 sm:gap-3" href="tel:+919096248660">
                            <i class="fas fa-phone-alt fa-flip-horizontal"></i>
                            +91-90962-48660
                        </a>
                    </p>
                    <p class="text-base text-gray-600 hover:text-emerald-600 sm:text-lg">
                        <a class="flex items-center gap-2 sm:gap-3" href="tel:+917775008660">
                            <i class="fas fa-phone-alt fa-flip-horizontal"></i>
                            +91-77750-08660
                        </a>
                    </p>
                </div>
            </div>

            <!-- Email & Social Card -->
            <div class="rounded-xl bg-white p-6 shadow-md sm:p-8">
                <div
                    class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 sm:mb-6 sm:h-16 sm:w-16">
                    <i class="fas fa-globe text-xl text-emerald-600 sm:text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 sm:text-2xl"><?php echo e(__('messages.getin_DigitalChannels')); ?>

                </h3>
                <div class="mt-4 space-y-3 sm:mt-6">
                    <p class="text-base text-gray-600 hover:text-emerald-600 sm:text-lg">
                        <a class="flex items-center gap-2 text-lg sm:gap-3" href="mailto:info.kisansat@gmail.com">
                            <i class="fas fa-envelope"></i>
                            info.kisansat@gmail.com
                        </a>
                    </p>
                    <!-- Social Media Links -->
                    <div class="mt-4 flex justify-center space-x-4 md:justify-start">
                        <a class="hover:text-emerald-600" href="https://www.facebook.com/profile.php?id=100093467838017"
                            target="_blank">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </a>
                        <a class="hover:text-emerald-600" href="https://x.com/kisan_sat" target="_blank">
                            <i class="fa-brands fa-twitter text-2xl"></i>
                        </a>
                        <a class="hover:text-emerald-600" href="https://www.instagram.com/kisansat/?hl=en"
                            target="_blank">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </a>
                        <a class="hover:text-emerald-600"
                            href="https://youtube.com/@kisansat-smartfarmingsolutions?si=VTdyMUe24CWK77aJ"
                            target="_blank">
                            <i class="fa-brands fa-youtube text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="mt-12 rounded-2xl bg-white p-6 shadow-xl sm:mt-16 sm:p-8 md:p-12">
            <h2 class="mb-6 text-center text-2xl font-bold text-gray-800 sm:mb-8 sm:text-3xl">
                <?php echo e(__('messages.getin_ContactUs')); ?></h2>
            <form class="mx-auto max-w-xl space-y-4 sm:space-y-6" method="POST"
                action="<?php echo e(route('contact-us.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="grid gap-4 sm:gap-6 md:grid-cols-2">
                    <div>
                        <label
                            class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg"><?php echo e(__('messages.getin_FullName')); ?><span
                                class="text-red-500">*</span></label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                            name="name" type="text" value="<?php echo e(old('name')); ?>"
                            placeholder="<?php echo e(__('messages.getin_Name_label')); ?>" required>

                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label
                            class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg"><?php echo e(__('messages.getin_Email')); ?>

                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                            name="email" type="email" value="<?php echo e(old('email')); ?>" placeholder="example@gmail.com"
                            required>

                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="grid gap-4 sm:gap-6 md:grid-cols-2">
                    <div>
                        <label
                            class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg"><?php echo e(__('messages.getin_Mobile')); ?><span
                                class="text-red-500">*</span></label>

                        <input class="input input-bordered w-full" name="mobile" type="tel"
                            value="<?php echo e(old('mobile')); ?>" pattern="[0-9]{10}" oninput="validateMobile(this)"
                            maxlength="10" placeholder="<?php echo e(__('messages.getin_Name_mobilenumber_label')); ?>" required>
                        <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg">
                            <?php echo e(__('messages.getin_Address')); ?></label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                            name="address" type="text" value="<?php echo e(old('address')); ?>"
                            placeholder="<?php echo e(__('messages.getin_Name_address_label')); ?>">
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div>
                    <label
                        class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg"><?php echo e(__('messages.getin_Message')); ?></label>
                    <textarea
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                        name="message" rows="5" placeholder="<?php echo e(__('messages.getin_Name_helpyou_label')); ?>"><?php echo e(old('message')); ?></textarea>

                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-sm text-red-500"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex">
                    <button
                        class="m-auto rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 hover:bg-emerald-700 sm:px-8 sm:py-4 sm:text-lg"
                        type="submit">
                        <?php echo e(__('messages.getin_SendMessage')); ?>

                    </button>
                </div>
            </form>
        </div>

        <!-- Map Section -->
        <div class="mt-12 overflow-hidden rounded-2xl shadow-xl sm:mt-16">
            <iframe class="rounded-2xl"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.259603507598!2d77.01349417470568!3d20.699680199001012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd72ff7f7e2c3c1%3A0x2d52bc3d17e08b6a!2seKisanZone!5e0!3m2!1sen!2sin!4v1742639229434!5m2!1sen!2sin"
                style="border:0;" width="100%" height="450" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- CTA Section -->
        <div class="mt-12 text-center sm:mt-16">
            <h3 class="mb-4 text-xl font-bold text-gray-800 sm:mb-6 sm:text-2xl">
                <?php echo e(__('messages.getin_JoinThousands')); ?></h3>
            <a class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-lg transition-all duration-300 hover:bg-emerald-700 hover:shadow-xl sm:px-8 sm:py-4 sm:text-lg"
                href="<?php echo e(env('ANDROID_APP_LINK')); ?>" target="_blank">
                <i class="fas fa-download mr-2 sm:mr-3"></i>
                <?php echo e(__('messages.getin_Download')); ?>

            </a>
            <p class="mt-3 text-sm text-gray-600 sm:mt-4 sm:text-base"> <?php echo e(__('messages.getin_AndriodPlaystore')); ?>

            </p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validateMobile(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 10);
        }



        document.addEventListener('DOMContentLoaded', function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "<?php echo e(session('success')); ?>",
                    timer: 7000, // Auto close after 3 seconds
                    showConfirmButton: false
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "<?php echo e(session('error')); ?>",
                    timer: 7000,
                    showConfirmButton: false
                });
            <?php endif; ?>
        });
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\contact-us.blade.php ENDPATH**/ ?>