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
    <div class="container prose mb-20 mt-3 max-w-5xl px-4 sm:px-6 lg:px-8">

        <?php if (isset($component)) { $__componentOriginal522a3c8aadb4ccbcc229d59265244da1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal522a3c8aadb4ccbcc229d59265244da1 = $attributes; } ?>
<?php $component = App\View\Components\PageHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PageHeader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('messages.privacypolicy_title')).'']); ?>
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

        <p>
            <?php echo e(__('messages.privacypolicy_desc_1')); ?>

        </p>
        <p>
            <b><?php echo e(__('messages.privacypolicy_desc_2_bold')); ?></b><?php echo e(__('messages.privacypolicy_desc_2')); ?>


        <ol class="pl-6" type="a">
            <li>
                <a href="https://kisansat.com/privacy-policy"
                    target="_blank"><?php echo e(__('messages.privacypolicy_PrivacyPolicyPage')); ?></a>
                <?php echo e(__('messages.privacypolicy_PrivacyPolicyPagedesc')); ?>

            </li>
            <li>
                <?php echo e(__('messages.privacypolicy_PrivacyPolicyrelated')); ?>

            </li>
            <li>
                <?php echo e(__('messages.privacypolicy_PrivacyPolicyrelated2')); ?>


            </li>
        </ol>
        </p>

        <p>
            <?php echo e(__('messages.privacypolicy_PrivacyPolicySite')); ?>

        </p>

        <p>
            <?php echo e(__('messages.privacypolicy_PrivacyPolicySite2')); ?>


        </p>

        <p>
            <?php echo e(__('messages.privacypolicy_PrivacyPolicySite3')); ?>

            <b><?php echo e(__('messages.privacypolicy_PrivacyPolicySite4')); ?></b>
            <?php echo e(__('messages.privacypolicy_PrivacyPolicySite5')); ?>

            <i><?php echo e(__('messages.privacypolicy_PrivacyPolicySite6')); ?></i>
            <?php echo e(__('messages.privacypolicy_PrivacyPolicySite7')); ?>

        </p>
        <ul class="pl-6">
            <li>
                <?php echo e(__('messages.privacypolicy_PrivacyPolicySite8')); ?>

            </li>
        </ul>

        <ol>
            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_typeofinfo_title')); ?></u></h3>
                <ol type="a">
                    <li>
                        <?php echo e(__('messages.privacypolicy_typeofinfo_1')); ?>

                        <ol type="i">
                            <li><b><u><?php echo e(__('messages.privacypolicy_typeofinfo_1i')); ?></u></b>
                                <?php echo e(__('messages.privacypolicy_typeofinfo_1i_desc')); ?></li>
                            <li><b><u><?php echo e(__('messages.privacypolicy_typeofinfo_1ii')); ?></u></b>
                                <?php echo e(__('messages.privacypolicy_typeofinfo_1ii_desc')); ?></li>
                            <li><b><u><?php echo e(__('messages.privacypolicy_typeofinfo_1iii')); ?></u></b>
                                <?php echo e(__('messages.privacypolicy_typeofinfo_1iii_desc')); ?></li>
                            <li><b><u><?php echo e(__('messages.privacypolicy_typeofinfo_1iv')); ?></u></b>
                                <?php echo e(__('messages.privacypolicy_typeofinfo_1iv_desc')); ?></li>
                            <li><b><u><?php echo e(__('messages.privacypolicy_typeofinfo_1v')); ?></u></b>
                                <?php echo e(__('messages.privacypolicy_typeofinfo_1v_desc')); ?></li>
                        </ol>
                    </li>
                </ol>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_childinfo_title')); ?></u></h3>
                <?php echo e(__('messages.privacypolicy_childinfo_desc')); ?>

                <a href="mailto:info.kisansat@gmail.com">info.kisansat@gmail.com</a>.
                <?php echo e(__('messages.privacypolicy_childinfo_desc2')); ?>


                <ol type="a">
                    <li><?php echo e(__('messages.privacypolicy_childinfo_point1')); ?></li>
                    <li><?php echo e(__('messages.privacypolicy_childinfo_point2')); ?></li>
                </ol>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_useinfo_title')); ?></u></h3>
                <ol type="a">
                    <li><?php echo e(__('messages.privacypolicy_useinfo_point1')); ?></li>
                    <li>
                        <?php echo e(__('messages.privacypolicy_useinfo_point2')); ?>

                        <ol type="i">
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_i')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_ii')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_iii')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_iv')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_v')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_vi')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_vii')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_viii')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_ix')); ?></li>
                            <li><?php echo e(__('messages.privacypolicy_useinfo_point2_x')); ?></li>
                            <li>
                                <?php echo e(__('messages.privacypolicy_useinfo_point2_xi')); ?>

                                <ul class="mt-2 list-[lower-roman] pl-6">
                                    <li><?php echo e(__('messages.privacypolicy_useinfo_point2_xi_1')); ?></li>
                                    <li><?php echo e(__('messages.privacypolicy_useinfo_point2_xi_2')); ?></li>
                                    <li><?php echo e(__('messages.privacypolicy_useinfo_point2_xi_3')); ?></li>
                                </ul>
                            </li>
                        </ol>
                    </li>
                </ol>
            </li>


            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_sharing_title')); ?></u></h3>
                <p>
                    <?php echo e(__('messages.privacypolicy_sharing_content')); ?>

                </p>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_dataretention_title')); ?></u></h3>
                <p>
                    <?php echo e(__('messages.privacypolicy_dataretention_intro')); ?>

                </p>
                <ol type="i">
                    <li><?php echo e(__('messages.privacypolicy_dataretention_point1')); ?></li>
                    <li><?php echo e(__('messages.privacypolicy_dataretention_point2')); ?></li>
                    <li><?php echo e(__('messages.privacypolicy_dataretention_point3')); ?></li>
                </ol>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_security_title')); ?></u></h3>
                <p>
                    <?php echo e(__('messages.privacypolicy_security_content')); ?>

                </p>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_thirdparty_title')); ?></u></h3>
                <p>
                    <?php echo e(__('messages.privacypolicy_thirdparty_content_1')); ?>

                </p>
                <p>
                    <?php echo e(__('messages.privacypolicy_thirdparty_content_2')); ?>

                </p>
            </li>


            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_advertising_title')); ?></u></h3>
                <p>
                    <?php echo e(__('messages.privacypolicy_advertising_content_1')); ?>

                </p>
                <p>
                    <?php echo e(__('messages.privacypolicy_advertising_content_2')); ?>

                </p>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_consent_title')); ?></u></h3>
                <p>
                    <?php echo e(__('messages.privacypolicy_consent_content')); ?>

                </p>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.privacypolicy_contact_title')); ?></u></h3>
                <p>
                    <?php echo __('messages.privacypolicy_contact_content'); ?>

                </p>
            </li>

        </ol>

        <div class="mt-8">
            <a class="btn btn-outline btn-primary rounded-lg px-6 py-2" href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.privacypolicy_BacktoHome')); ?></a>
        </div>
    </div>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\privacy-policy.blade.php ENDPATH**/ ?>