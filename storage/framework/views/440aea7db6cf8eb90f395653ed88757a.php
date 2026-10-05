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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Farms Monitoring API Logs')]); ?>
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
    </style>

    <div class="  mt-5">


        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">

            <div x-data="{
                openTab: 1,
                activeClasses: 'text-primary border-primary',
                inactiveClasses: 'border-transparent',
            }" class="mb-14 w-full p-7">
                <div class="mb-6 flex flex-wrap gap-5 border-b border-stroke dark:border-strokedark sm:gap-10">
                    <a href="#" @click.prevent="openTab = 1"
                        :class="openTab === 1 ? activeClasses : inactiveClasses"
                        class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base">
                        Farm Monitoring API Logs
                    </a>
                </div>
                <div>
                    <div x-show="openTab === 1" class="font-medium leading-relaxed">

                        <table class="table" id="farm_api_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    
                                    <th>Farmer Name</th>
                                    <th>Farm ID</th>
                                    <th>Farm Name</th>
                                    <th>Kisan SAT API Status</th>
                                    <th>Satyukt API Status</th>
                                    <th>Database Status</th>
                                    <th>Service Report Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $monitorings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monitoring): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($monitoring->farms->user->name); ?> </td>
                                        <td><?php echo e($monitoring->farms->farm_id); ?> </td>
                                        <td><?php echo e($monitoring->farms->name); ?> </td>
                                        <td><?php echo e($monitoring->status); ?></td>
                                        <td><?php echo e($monitoring->status); ?> </td>
                                        <td><?php echo e($monitoring->status); ?> </td>
                                        <td><?php echo e($monitoring->status); ?> </td>
                                        
                                        <td>
                                            <a class="  items-center gap-2 text-info"
                                                href="<?php echo e(route('monitoring-api_error_log', $monitoring->farms->farm_id)); ?>">
                                                <i class="fas fa-eye text-2xl px-2"></i>
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
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

        <script>
            document.addEventListener('alpine:init', () => {
                let dt = new DataTable("#farm_api_Table", {

                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    paging: true,
                    // scrollX: true,
                    // scrollY: "550px",
                    // scrollCollapse: false,
                    // autoWidth: false,
                    columnDefs: [{
                        width: "100px",
                        targets: "_all"
                    }],
                    layout: {
                        topStart: {
                            buttons: [{
                                    extend: "pageLength",
                                },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Farm Monitoring API Error Log Details)",

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 5, 6, 7
                                        ],
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Farm Monitoring API Error Log Details)',

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 5, 6, 7
                                        ],
                                    },
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\monitoring\index.blade.php ENDPATH**/ ?>