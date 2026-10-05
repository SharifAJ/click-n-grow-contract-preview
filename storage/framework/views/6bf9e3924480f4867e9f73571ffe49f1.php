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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.terms_title'))]); ?>
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

        <ol>
            <li>
                <h3><u><?php echo e(__('messages.terms_general_heading')); ?></u></h3>

                <p class="text-justify"><?php echo __('messages.terms_general_para1'); ?></p>
                <p class="text-justify"><?php echo __('messages.terms_general_para2'); ?></p>
                <p class="text-justify"><?php echo __('messages.terms_general_para3'); ?></p>
            </li>
            <li>
                <h3><u><?php echo e(__('messages.proprietary_rights_title')); ?></u></h3>
                <ol type="a">
                    <li><?php echo __('messages.proprietary_rights_point_a'); ?></li>
                    <li><?php echo __('messages.proprietary_rights_point_b'); ?></li>
                </ol>
            </li>

            <li>
                <h3><u><?php echo e(__('messages.usage_of_application_title')); ?></u></h3>
                <ol type="a">
                    <li><?php echo __('messages.usage_of_application_point_a'); ?></li>
                    <li><?php echo __('messages.usage_of_application_point_b'); ?></li>
                    <li><?php echo __('messages.usage_of_application_point_c'); ?></li>
                    <li><?php echo __('messages.usage_of_application_point_d'); ?></li>
                </ol>
            </li>

            

            <li>
                <h3><u><?php echo __('messages.privacy_policy_title'); ?></u></h3>
                <p><?php echo __('messages.privacy_policy_content'); ?></p>
            </li>
            <li>
                <h3><u><?php echo __('messages.exactness_not_guaranteed_title'); ?></u></h3>
                <p><?php echo __('messages.exactness_not_guaranteed_content'); ?></p>
            </li>

            <li>
                <h3><u><?php echo __('messages.third_party_links_title'); ?></u></h3>
                <p><?php echo __('messages.third_party_links_content'); ?></p>
            </li>

            <li>
                <h3><u><?php echo __('messages.disclaimer_of_warranty_title'); ?></u></h3>
                <p><?php echo __('messages.disclaimer_of_warranty_content'); ?></p>
            </li>

            <li>
                <h3><u><?php echo __('messages.limitation_of_liability_title'); ?></u></h3>
                <ol type="a">
                    <li><?php echo __('messages.limitation_of_liability_point_a'); ?></li>
                    <li><?php echo __('messages.limitation_of_liability_point_b'); ?></li>
                </ol>
            </li>

            <li>
                <h3><u><?php echo __('messages.indemnity_title'); ?></u></h3>
                <p><?php echo __('messages.indemnity_description'); ?></p>
            </li>
            <li>
                <h3><u><?php echo __('messages.pricing_title'); ?></u></h3>
                <p><?php echo __('messages.pricing_description'); ?></p>
            </li>

            <li>
                <h3><u><?php echo __('messages.force_majeure_title'); ?></u></h3>
                <p><?php echo __('messages.force_majeure_description'); ?></p>
            </li>

            <li>
                <h3><u><?php echo __('messages.suspension_termination_title'); ?></u></h3>
                <ol type="a">
                    <li><?php echo __('messages.suspension_termination_point1'); ?>

                        <ol type="a">
                            <li><?php echo __('messages.suspension_termination_point1_a'); ?></li>
                            <li><?php echo __('messages.suspension_termination_point1_b'); ?></li>
                            <li><?php echo __('messages.suspension_termination_point1_c'); ?></li>
                            <li><?php echo __('messages.suspension_termination_point1_d'); ?></li>
                            <li><?php echo __('messages.suspension_termination_point1_e'); ?></li>
                        </ol>
                    </li>
                    <li><?php echo __('messages.suspension_termination_point2'); ?></li>
                    <li><?php echo __('messages.suspension_termination_point3'); ?></li>
                </ol>
            </li>

            <li>
                <h3><u><?php echo __('messages.governing_law_title'); ?></u></h3>
                <p><?php echo __('messages.governing_law_paragraph'); ?></p>
            </li>

        </ol>

        <div class="mt-8">
            <a class="btn btn-outline btn-primary rounded-lg px-6 py-2"
                href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.privacypolicy_BacktoHome')); ?></a>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\pages\terms-and-conditions.blade.php ENDPATH**/ ?>