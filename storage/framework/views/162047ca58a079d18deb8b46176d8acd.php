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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Farmer Subscriptions'))]); ?>
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
        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">
            <div class="mb-14 w-full p-7" x-data="{
                openTab: 1,
                activeClasses: 'text-primary border-primary',
                inactiveClasses: 'border-transparent',
            }">
                <div class="border-stroke dark:border-strokedark mb-6 flex flex-wrap gap-5 border-b sm:gap-10">
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 1" :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Admin Subscriptions
                    </a>
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses">
                        Mobile Subscriptions
                    </a>
                </div>


                <div class="w-full">
                    <div class="bg-white" x-show="openTab === 1">
                        <div class="text-end">
                            <a href="<?php echo e(route('subscription.create')); ?>" class="btn btn-success text-white">
                                New Farmer Subscription
                            </a>
                        </div>

                        <table id="Admins_Table" class="table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Total Subscriptions</th>
                                    <th>Total Amount</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $subscriptionsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $totalAmount = 0;

                                        foreach ($subscription->farms as $farm) {
                                            foreach ($farm->subscriptions as $farmSubscription) {
                                                if ($farmSubscription->payment_status === 'completed') {
                                                    $totalAmount += $farmSubscription->amount;
                                                }
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($subscription->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($subscription->mobile ?? 'N/A'); ?></td>
                                        <td><?php echo e($subscription->email ?? 'N/A'); ?></td>
                                        <td x-data="{ loading: false, userData: null }">
                                            <button class="btn btn-ghost text-secondary underline"
                                                @click="
                                                loading = true;
                                                userData = <?php echo e(json_encode($subscription)); ?>;
                                                $dispatch('open-modal', 'admin_subscriptions_modal_<?php echo e($subscription->id); ?>');
                                                loading = false;
                                            ">
                                                <?php echo e($subscription->total_subscriptions_count); ?>

                                            </button>

                                            <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['maxWidth' => '7xl','name' => 'admin_subscriptions_modal_'.e($subscription->id).'','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['maxWidth' => '7xl','name' => 'admin_subscriptions_modal_'.e($subscription->id).'','focusable' => true]); ?>
                                                <div class="p-4 overflow-x-auto">
                                                    <h3 class="text-lg font-bold">Subscription Details</h3>
                                                    <table
                                                        class="table mt-4 w-full border-collapse border border-gray-300">
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th class="border p-2">#</th>
                                                                <th class="border p-2">Subscription ID</th>
                                                                <th class="border p-2">Farm ID</th>
                                                                <th class="border p-2">Farm Name</th>
                                                                <th class="border p-2">Farm Area</th>
                                                                <th class="border p-2">Crop Type</th>
                                                                <th class="border p-2">Subscription Type</th>
                                                                <th class="border p-2">Subscription Name</th>
                                                                <th class="border p-2">Subscription Duration</th>
                                                                <th class="border p-2">Amount</th>
                                                                <th class="border p-2">Start Date</th>
                                                                <th class="border p-2">End Date</th>
                                                                <th class="border p-2">Payment Status</th>
                                                                <th class="border p-2">Subscription Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template x-if="userData">
                                                                <template
                                                                    x-for="(user, index) in userData.farms.flatMap(farm => 
                                                                    farm.subscriptions.map(sub => ({...sub, farm})))"
                                                                    :key="user.id">
                                                                    <tr>
                                                                        <td class="border p-2" x-text="index + 1"></td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscription_code ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.farm.farm_id"></td>
                                                                        <td class="border p-2" x-text="user.farm.name">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.farm.area ? Math.floor(parseFloat(user.farm.area) * 10) / 10 : '0.0'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="user.farm.croptype"></td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                                        ? 'Package' 
                                                                                        : 'Premium Services'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.name ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.duration_labels ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.amount ?? 'N/A'"></td>
                                                                        <td class="border p-2"
                                                                            x-text="user.starts_at 
                                                                                ? new Date(user.starts_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.expires_at 
                                                                                ? new Date(user.expires_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>



                                                                        <td class="border p-2"
                                                                            x-text="user.payment_status 
                                                                                        ? user.payment_status.charAt(0).toUpperCase() + user.payment_status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.status 
                                                                                        ? user.status.charAt(0).toUpperCase() + user.status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>

                                                            

                                                            


                                                        </tbody>
                                                    </table>
                                                </div>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
                                        </td>

                                        <td><?php echo e(number_format($totalAmount, 2)); ?></td>
                                        

                                        <td>
                                            <a class="  items-center gap-2 text-info"
                                                href="<?php echo e(route('subscription.show', $subscription->id)); ?>">
                                                <i class="fas fa-eye text-2xl px-2"></i>
                                            </a>
                                            
                                            <a class="  items-center gap-2 text-warning"
                                                href="<?php echo e(route('subscription.edit', $subscription->id)); ?>">
                                                <i class="fas fa-edit text-2xl px-2"></i>
                                            </a>
                                            
                                        </td>

                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="bg-white" x-show="openTab === 2">
                        

                        <table id="Users_Table" class="table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Total Subscriptions</th>
                                    <th>Total Amount</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users_subscriptionsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user_subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $usertotalamt = 0;
                                        foreach ($user_subscription->farms as $user_farm) {
                                            foreach ($user_farm->subscriptions as $user_farmSubscription) {
                                                if ($user_farmSubscription->payment_status === 'completed') {
                                                    $usertotalamt += $user_farmSubscription->amount;
                                                }
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($user_subscription->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($user_subscription->mobile ?? 'N/A'); ?></td>
                                        <td><?php echo e($user_subscription->email ?? 'N/A'); ?></td>
                                        <td x-data="{ loading: false, userData: null }">
                                            <button class="btn btn-ghost text-secondary underline"
                                                @click="
                                                loading = true;
                                                userData = <?php echo e(json_encode($user_subscription)); ?>;
                                                $dispatch('open-modal', 'user_subscriptions_modal_<?php echo e($user_subscription->id); ?>');
                                                loading = false;
                                            ">
                                                <?php echo e($user_subscription->total_subscriptions_count); ?>

                                            </button>

                                            <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['maxWidth' => '7xl','name' => 'user_subscriptions_modal_'.e($user_subscription->id).'','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['maxWidth' => '7xl','name' => 'user_subscriptions_modal_'.e($user_subscription->id).'','focusable' => true]); ?>
                                                <div class="p-4 overflow-x-auto">
                                                    <h3 class="text-lg font-bold">Subscription Details</h3>
                                                    <table
                                                        class="table mt-4 w-full border-collapse border border-gray-300">
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th class="border p-2">#</th>
                                                                <th class="border p-2">Subscription ID</th>
                                                                <th class="border p-2">Farm ID</th>
                                                                <th class="border p-2">Farm Name</th>
                                                                <th class="border p-2">Farm Area</th>
                                                                <th class="border p-2">Crop Type</th>
                                                                <th class="border p-2">Subscription Type</th>
                                                                <th class="border p-2">Subscription Name</th>
                                                                <th class="border p-2">Subscription Duration</th>
                                                                <th class="border p-2">Amount</th>
                                                                <th class="border p-2">Start Date</th>
                                                                <th class="border p-2">End Date</th>
                                                                <th class="border p-2">Payment Status</th>
                                                                <th class="border p-2">Subscription Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template x-if="userData">
                                                                <template
                                                                    x-for="(user, index) in userData.farms.flatMap(farm => 
                                                                    farm.subscriptions.map(sub => ({...sub, farm})))"
                                                                    :key="user.id">
                                                                    <tr>
                                                                        <td class="border p-2" x-text="index + 1">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscription_code ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.farm.farm_id"></td>
                                                                        <td class="border p-2"
                                                                            x-text="user.farm.name">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.farm.area ? Math.floor(parseFloat(user.farm.area) * 10) / 10 : '0.0'">
                                                                        </td>


                                                                        <td class="border p-2"
                                                                            x-text="user.farm.croptype"></td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable_type === 'App\\Models\\PackageMasterModel' 
                                                                                        ? 'Package' 
                                                                                        : 'Premium Services'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.name ?? 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.subscribable?.duration_labels ?? 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.amount ?? 'N/A'"></td>
                                                                        <td class="border p-2"
                                                                            x-text="user.starts_at 
                                                                                ? new Date(user.starts_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>

                                                                        <td class="border p-2"
                                                                            x-text="user.expires_at 
                                                                                ? new Date(user.expires_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(' ', '-') 
                                                                                : 'N/A'">
                                                                        </td>



                                                                        <td class="border p-2"
                                                                            x-text="user.payment_status 
                                                                                        ? user.payment_status.charAt(0).toUpperCase() + user.payment_status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                        <td class="border p-2"
                                                                            x-text="user.status 
                                                                                        ? user.status.charAt(0).toUpperCase() + user.status.slice(1) 
                                                                                        : 'N/A'">
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>

                                                            

                                                            


                                                        </tbody>
                                                    </table>
                                                </div>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
                                        </td>

                                        <td><?php echo e(number_format($usertotalamt, 2)); ?></td>
                                        

                                        <td>
                                            <a class="  items-center gap-2 text-info"
                                                href="<?php echo e(route('user_subscription.show', $user_subscription->id)); ?>">
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
                        showConfirmButton: true, // ✅ "OK" button enable
                        confirmButtonText: "OK" // ✅ Custom "OK" button text
                    });
                <?php endif; ?>

            });
        </script>




        <script>
            document.addEventListener('alpine:init', () => {
                let dt = new DataTable("#Admins_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    paging: true,
                    // scrollX: true,
                    // scrollY: "550px",
                    // scrollCollapse: false,
                    // autoWidth: false,
                    layout: {
                        topStart: {
                            buttons: [{
                                    extend: "pageLength",
                                },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Admin Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },
                                },
                                {
                                    extend: "print",
                                    text: "Print",
                                    title: "KisanSat (Admin Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    }
                                },
                            ],
                        },
                    }
                });

                // // 🔹 Fix misalignment after table is drawn
                // dt.on("draw", function() {
                //     setTimeout(function() {
                //         dt.columns.adjust().draw();
                //     }, 200);
                // });

                // // 🔹 Fix misalignment when window resizes
                // $(window).on("resize", function() {
                //     dt.columns.adjust().draw();
                // });

                // // 🔹 Force DataTable to adjust column widths correctly
                // setTimeout(() => {
                //     dt.columns.adjust().draw();
                // }, 500);
            });
            document.addEventListener('alpine:init', () => {
                let dt = new DataTable("#Users_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    paging: true,
                    layout: {
                        topStart: {
                            buttons: [{
                                    extend: "pageLength",
                                },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Mobile Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },

                                },
                                {
                                    extend: "print",
                                    text: "Print",
                                    title: "KisanSat (Mobile Subscriptions Details)",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 5, ],
                                    },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    }
                                },
                            ],
                        },
                    }
                });

                // // 🔹 Fix misalignment after table is drawn
                // dt.on("draw", function() {
                //     setTimeout(function() {
                //         dt.columns.adjust().draw();
                //     }, 200);
                // });

                // // 🔹 Fix misalignment when window resizes
                // $(window).on("resize", function() {
                //     dt.columns.adjust().draw();
                // });

                // // 🔹 Force DataTable to adjust column widths correctly
                // setTimeout(() => {
                //     dt.columns.adjust().draw();
                // }, 500);
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farmer_subscription\index.blade.php ENDPATH**/ ?>