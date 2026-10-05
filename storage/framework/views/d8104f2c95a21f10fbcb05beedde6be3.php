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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Payment Transaction'))]); ?>
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





    <div class="  mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">

            <div x-data="{
                openTab: 1,
                activeClasses: 'text-primary border-primary',
                inactiveClasses: 'border-transparent',
            }" class="mb-14 w-full p-7">

                <div class="mb-6 flex flex-wrap gap-5 border-b border-stroke dark:border-strokedark sm:gap-10">
                    <a href="#" @click.prevent="openTab = 1"
                        :class="openTab === 1 ? activeClasses : inactiveClasses"
                        class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base">
                        Payments
                    </a>
                </div>
                <div>

                    <div class="w-full">
                        <div class="bg-white" x-show="openTab === 1">
                            

                            <!-- Modal -->
                            

                            <table id="first_Table" class="table table-zebra">
                                <thead class="text-primary-content">
                                    <tr>
                                        <th>#</th>
                                        <th>Bill id</th>
                                        <th>Farmer</th>
                                        <th>Farm name</th>
                                        <th>Service Subscription </th>
                                        <th>Amount</th>
                                        
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $payments = [
                                            [
                                                'bill_id' => 'BILL001',
                                                'farmer' => 'John Doe',
                                                'farm_name' => 'Green Farm',
                                                'service' => 'Irrigation',
                                                'amount' => 500,
                                                'payment_type' => 'UPI',
                                                'payment_status' => 'Completed',
                                                'remark' => 'Paid on time',
                                            ],
                                            [
                                                'bill_id' => 'BILL002',
                                                'farmer' => 'Alice Smith',
                                                'farm_name' => 'Sunshine Farm',
                                                'service' => 'Fertilization',
                                                'amount' => 300,
                                                'payment_type' => 'Cash',
                                                'payment_status' => 'Pending',
                                                'remark' => 'Waiting for confirmation',
                                            ],
                                            [
                                                'bill_id' => 'BILL003',
                                                'farmer' => 'Raj Kumar',
                                                'farm_name' => 'Organic Fields',
                                                'service' => 'Pest Control',
                                                'amount' => 450,
                                                'payment_type' => 'Bank Transfer',
                                                'payment_status' => 'Completed',
                                                'remark' => 'Confirmed',
                                            ],
                                            [
                                                'bill_id' => 'BILL004',
                                                'farmer' => 'Mohan Das',
                                                'farm_name' => 'Harvest Hub',
                                                'service' => 'Soil Testing',
                                                'amount' => 250,
                                                'payment_type' => 'Credit Card',
                                                'payment_status' => 'Failed',
                                                'remark' => 'Retry needed',
                                            ],
                                            [
                                                'bill_id' => 'BILL005',
                                                'farmer' => 'Sneha Patil',
                                                'farm_name' => 'Fresh Farm',
                                                'service' => 'Drip Irrigation',
                                                'amount' => 600,
                                                'payment_type' => 'UPI',
                                                'payment_status' => 'Completed',
                                                'remark' => 'Smooth transaction',
                                            ],
                                        ];
                                    ?>

                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e($payment['bill_id']); ?></td>
                                            <td><?php echo e($payment['farmer']); ?></td>
                                            <td><?php echo e($payment['farm_name']); ?></td>
                                            <td><?php echo e($payment['service']); ?></td>
                                            <td>₹<?php echo e(number_format($payment['amount'], 2)); ?></td>
                                            <td><?php echo e($payment['payment_type']); ?></td>
                                            <td
                                                class="<?php echo e($payment['payment_status'] == 'Completed' ? 'text-green-500' : ($payment['payment_status'] == 'Pending' ? 'text-yellow-500' : 'text-red-500')); ?>">
                                                <?php echo e($payment['payment_status']); ?>

                                            </td>
                                            <td><?php echo e($payment['remark']); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            $('#farmerSelect').select2({
                dropdownParent: $("#paymentModal") // Ensure dropdown works inside modal
            });
        });

        function openModal() {
            document.getElementById("paymentModal").showModal();
            setTimeout(() => {
                $('#farmerSelect').select2({
                    dropdownParent: $("#paymentModal") // Reinitialize Select2 inside modal
                });
            }, 100);
        }

        function closeModal() {
            document.getElementById("paymentModal").close();
        }
    </script>
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            let dt = new DataTable("#first_Table", {
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"],
                ],
                    paging: true,
                
                layout: {
                    topStart: {
                        buttons: [{
                                extend: "pageLength",
                            },
                            {
                                extend: "excel",
                                text: "Excel",
                                title: "KisanSat (Farmer Details)",

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4,
                                    ],
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'KisanSat (Farmer Details)',

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4,
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\payment\index.blade.php ENDPATH**/ ?>