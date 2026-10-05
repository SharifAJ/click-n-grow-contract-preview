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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Farm Monitoring API Error Log'))]); ?>
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

                <div class="w-full p-5">
                    <table class="table border border-gray-300">
                        <thead>
                            <tr>
                                <td class="border border-gray-300">#</td>
                                <td class="border border-gray-300">Report Generated At</td>
                                <td class="border border-gray-300">Service Name</td>
                                <td class="border border-gray-300">Report Updated At</td>
                                <td class="border border-gray-300">API Report Status</td>
                                <td class="border border-gray-300">API Count</td>
                                <td class="border border-gray-300">Error Message (if any)</td>
                            </tr>
                        </thead>
                        <tbody>



                            
                            <tr>
                                <td class="border border-gray-300">1</td>
                                <td class="border border-gray-300"> N/A
                                </td>
                                <td class="border border-gray-300">Land Area Mapping</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">0</td>
                                <td class="border border-gray-300">N/A </td>
                            </tr>

                            
                            <tr>
                                <td class="border border-gray-300">2</td>
                                <?php if(optional($weather)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($weather->created_at ?? 'N/A'))); ?></td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>

                                <td class="border border-gray-300">Weather Forecasting</td>
                                <?php if(optional($weather)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($weather->updated_at ?? 'N/A'))); ?></td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>

                                <td class="border border-gray-300"><?php echo e(ucfirst($weather->api_status ?? 'N/A')); ?></td>

                                <td class="border border-gray-300"><?php echo e($weatherCount); ?></td>
                                <td class="border border-gray-300"><?php echo e($weather->error_message ?? 'N/A'); ?></td>
                            </tr>

                            
                            <tr>
                                <td class="border border-gray-300">3</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">Mandi Rates</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">0</td>
                                <td class="border border-gray-300">N/A</td>
                            </tr>

                            
                            <tr>
                                <td class="border border-gray-300">4</td>
                                <?php if(optional($SoilNutrient)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($SoilNutrient->created_at ?? 'N/A'))); ?></td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">Soil Nutrient Analysis</td>
                                <?php if(optional($SoilNutrient)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($SoilNutrient->updated_at ?? 'N/A'))); ?></td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>

                                <td class="border border-gray-300">
                                    <?php echo e($SoilNutrient && $SoilNutrient->api_status ? ucfirst($SoilNutrient->api_status) : 'N/A'); ?>

                                </td>

                                <td class="border border-gray-300"><?php echo e($SoilNutrientCount); ?></td>
                                <td class="border border-gray-300"><?php echo e($SoilNutrient->error_message ?? 'N/A'); ?></td>
                            </tr>

                            
                            <tr>
                                <td class="border border-gray-300">5</td>
                                <?php if(optional($PestsDiseases)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($PestsDiseases->created_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">Pests & Diseases Forewarning</td>

                                <?php if(optional($PestsDiseases)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($PestsDiseases->updated_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">
                                    <?php echo e($PestsDiseases && $PestsDiseases->api_status ? ucfirst($PestsDiseases->api_status) : 'N/A'); ?>

                                </td>
                                <td class="border border-gray-300"><?php echo e($PestsDiseasesCount); ?></td>

                                <td class="border border-gray-300"><?php echo e($PestsDiseases->error_message ?? 'N/A'); ?></td>
                            </tr>

                            
                            <tr>
                                <td class="border border-gray-300">6</td>
                                <?php if(optional($setallites)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($setallites->created_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">Crop Health Analysis</td>
                                <?php if(optional($setallites)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($setallites->updated_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">
                                    <?php echo e($setallites && $setallites->api_status ? ucfirst($setallites->api_status) : 'N/A'); ?>

                                </td>
                                <td class="border border-gray-300"><?php echo e($setallitesCount); ?></td>
                                <td class="border border-gray-300"><?php echo e($setallites->error_message ?? 'N/A'); ?></td>
                            </tr>
                            
                            <tr>
                                <td class="border border-gray-300">7</td>
                                <?php if(optional($ImageDiagnosis)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($ImageDiagnosis->created_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">Image-Based Diagnosis</td>

                                <?php if(optional($ImageDiagnosis)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($ImageDiagnosis->updated_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">
                                    <?php echo e($ImageDiagnosis && $ImageDiagnosis->api_status ? ucfirst($ImageDiagnosis->api_status) : 'N/A'); ?>

                                </td>
                                <td class="border border-gray-300"><?php echo e($ImageDiagnosisCount); ?></td>

                                <td class="border border-gray-300"><?php echo e($ImageDiagnosis->error_message ?? 'N/A'); ?></td>
                            </tr>
                            
                            <tr>
                                <td class="border border-gray-300">8</td>
                                <?php if(optional($setallites)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($setallites->created_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">Soil Moisture Estimation</td>
                                <?php if(optional($setallites)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($setallites->updated_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">
                                    <?php echo e($setallites && $setallites->api_status ? ucfirst($setallites->api_status) : 'N/A'); ?>

                                </td>

                                <td class="border border-gray-300"><?php echo e($setallitesCount); ?></td>

                                <td class="border border-gray-300"><?php echo e($setallites->error_message ?? 'N/A'); ?></td>
                            </tr>

                            
                            <tr>
                                <td class="border border-gray-300">9</td>
                                <?php if(optional($CropCalendar)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($CropCalendar->created_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">Crop Calendar</td>
                                <?php if(optional($CropCalendar)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($CropCalendar->updated_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>
                                <td class="border border-gray-300">
                                    <?php echo e($CropCalendar && $CropCalendar->api_status ? ucfirst($CropCalendar->api_status) : 'N/A'); ?>

                                </td>
                                <td class="border border-gray-300"><?php echo e($CropCalendarCount); ?></td>

                                <td class="border border-gray-300"><?php echo e($CropCalendar->error_message ?? 'N/A'); ?></td>
                            </tr>
                            
                            <tr>
                                <td class="border border-gray-300">10</td>
                                <?php if(optional($OptimalIrrigation)->created_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($OptimalIrrigation->created_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>

                                <td class="border border-gray-300">Optimal Irrigation</td>

                                <?php if(optional($OptimalIrrigation)->updated_at): ?>
                                    <td class="border border-gray-300">
                                        <?php echo e(date('d-M-Y h:i:s A', strtotime($OptimalIrrigation->updated_at ?? 'N/A'))); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="border border-gray-300">N/A</td>
                                <?php endif; ?>

                                <td class="border border-gray-300">
                                    <?php echo e($OptimalIrrigation && $OptimalIrrigation->api_status ? ucfirst($OptimalIrrigation->api_status) : 'N/A'); ?>

                                </td>
                                <td class="border border-gray-300"><?php echo e($OptimalIrrigationCount); ?></td>

                                <td class="border border-gray-300"><?php echo e($OptimalIrrigation->error_message ?? 'N/A'); ?>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <a href="<?php echo e(route('monitoring.index')); ?>" class="btn btn-neutral mt-4 text-white">
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\monitoring\farm_monitoring_api_error_log.blade.php ENDPATH**/ ?>