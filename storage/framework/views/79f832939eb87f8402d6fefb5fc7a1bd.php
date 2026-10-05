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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Business Associate Enquiries'))]); ?>
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
    <style>
        input[type="checkbox"] {
            position: relative;
            width: 52px;
            height: 23px;
            -webkit-appearance: none;
            appearance: none;
            background: rgb(255 0 0);
            outline: none;
            border-radius: 2rem;
            cursor: pointer;
            box-shadow: inset 0 0 5px rgb(0 0 0 / 50%);
        }
        input[type="checkbox"]::before {
            content: "";
            width: 25px;
            height: 22px;
            border-radius: 50%;
            background: #fff;
            position: absolute;
            top: 0;
            left: 1px;
            transition: 0.5s;
        }
        input[type="checkbox"]:checked::before {
            transform: translateX(100%);
            background: #fff;
        }
        input[type="checkbox"]:checked {
            background: #00ed64;
        }
        [type='checkbox']:checked:hover,
        [type='checkbox']:checked:focus,
        [type='radio']:checked:hover,
        [type='radio']:checked:focus {
            border-color: transparent !important;
            background-color: #00ed64 !important;
        }
    </style>

    <div class="mt-5">
        <div class="bg-white border rounded-sm border-stroke shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="w-full mb-14 p-7"
                x-data="{
                    openTab: 1,
                    activeClasses: 'text-primary border-primary',
                    inactiveClasses: 'border-transparent',
                }"
            >
                <div class="flex flex-wrap gap-5 mb-6 border-b border-stroke dark:border-strokedark sm:gap-10">
                    <!-- <span class="py-4 text-sm font-medium border-b-2 text-primary md:text-base">
                        Business Associate Enquiries
                    </span> -->
                    
                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 1" :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Business Associate Enquiries
                    </a>

                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" :href="route('contract_farming.farmers.index')"
                        @click.prevent="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses">
                        Farmers Enquiries
                    </a>

                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 3" :class="openTab === 3 ? activeClasses : inactiveClasses">
                        FNO Enquiries
                    </a>
                </div>

                <div class="w-full">
                    <div class="bg-white">
                        <table class="table" id="business_associates_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>State/District/Taluka</th>
                                    <th>Business Type</th>
                                    <th>Interested Crop(s)</th>
                                    <th>Expected Start</th>
                                    <th>Support Required</th>
                                    <th>Profile</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($record->company_name ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->contact_person ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->mobile ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->email ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->state_district_taluka ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->business_type ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->interested_crop ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->expected_start_time ?? 'N/A'); ?></td>
                                        <td>
                                            <?php if($record->support_required): ?>
                                                <?php echo e(is_array($record->support_required) ? implode(', ', $record->support_required) : $record->support_required); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($record->upload_profile): ?>
                                                <a href="<?php echo e(asset('storage/'.$record->upload_profile)); ?>" target="_blank" class="text-blue-500">View</a>
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($record->remarks ?? 'N/A'); ?></td>
                                        <td><?php echo e($record->created_at ? $record->created_at->format('d-M-Y') : 'N/A'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php if(session('success')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "<?php echo e(session('success')); ?>",
                        timer: 7000,
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

        
        <script>
            $(document).ready(function() {
                new DataTable("#business_associates_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    paging: true,
                    layout: {
                        topStart: {
                            buttons: [
                                { extend: "pageLength" },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Business Associate Enquiries)",
                                    exportOptions: { columns: ':visible' }
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Business Associate Enquiries)',
                                    exportOptions: { columns: ':visible' },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    }
                                }
                            ],
                        },
                    },
                });
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\contract_farming\business_associate\index.blade.php ENDPATH**/ ?>