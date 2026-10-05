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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Farmers'))]); ?>
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
                        Farmers
                    </a>

                </div>


                <div class="w-full">
                    <div class="bg-white" x-show="openTab === 1">
                        <div class="text-end">
                            <a href="<?php echo e(route('farmer.create')); ?>" class="btn btn-success text-white">
                                New Farmer
                            </a>
                        </div>

                        <table class="table" id="farmer_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer ID</th>
                                    <th>Name</th>
                                    
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Total Farms</th>
                                    <th>Registration Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($user->farmer_id ?? 'N/A'); ?></td>
                                        <td>
                                            <a class="hover:underline" href="<?php echo e(route('farmer.show', $user->id)); ?>">
                                                <?php echo e($user->name); ?>

                                            </a>
                                        </td>
                                        
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->mobile ?? 'N/A'); ?></td>
                                        
                                        <td x-data="{ loading: false, farms: [] }">
                                            <button class="btn btn-ghost text-secondary underline"
                                                @click="
                                                    loading = true;
                                                    farms = <?php echo e($user->farms->toJson()); ?>; 
                                                    $dispatch('open-modal', 'user_farms_modal_<?php echo e($user->id); ?>');
                                                    loading = false; 
                                                ">
                                                <?php echo e($user->farms_count); ?>

                                            </button>

                                            <!-- Modal -->
                                            <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['maxWidth' => '7xl','name' => 'user_farms_modal_'.e($user->id).'','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['maxWidth' => '7xl','name' => 'user_farms_modal_'.e($user->id).'','focusable' => true]); ?>
                                                <div class="p-4 overflow-x-auto">
                                                    <h3 class="text-lg font-bold">Farm Details</h3>
                                                    <table
                                                        class="table mt-4 w-full border-collapse border border-gray-300">
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th class="border p-2">#</th>
                                                                <th class="border p-2">Farm ID</th>
                                                                <th class="border p-2">Farm Name</th>
                                                                <th class="border p-2">Crop Type</th>
                                                                
                                                                <th class="border p-2">Sowing Date</th>
                                                                <th class="border p-2">Crop Variety</th>
                                                                <th class="border p-2">Location</th>
                                                                <th class="border p-2">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template x-for="(farm, index) in farms"
                                                                :key="farm.id">
                                                                <tr>
                                                                    <td class="border p-2" x-text="index + 1"></td>
                                                                    <td class="border p-2" x-text="farm.farm_id"></td>
                                                                    <td class="border p-2" x-text="farm.name"></td>
                                                                    <td class="border p-2" x-text="farm.croptype"></td>
                                                                    
                                                                    <td class="border p-2" x-text="farm.sowingdate">
                                                                    </td>
                                                                    <td class="border p-2"
                                                                        x-text="farm.crop_variety ?? 'N/A'">
                                                                    </td>
                                                                    <td class="border p-2"
                                                                        x-text="`${farm.district}, ${farm.state}`"></td>
                                                                    <td class="border p-2" x-text="farm.status"></td>
                                                                </tr>
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
                                        <td><?php echo e(date('d-M-Y', strtotime($user->reg_date))); ?></td>

                                        
                                        <?php if($user->deleted_at == null): ?>
                                            <td>Active</td>
                                        <?php else: ?>
                                            <td>Inactive</td>
                                        <?php endif; ?>

                                        <td class="flex" style="height: 65px">
                                            <a class="  items-center gap-2 text-info"
                                                href="<?php echo e(route('farmer.show', $user->id)); ?>">
                                                <i class="fas fa-eye text-2xl px-2"></i>
                                            </a>
                                            <?php if($user->deleted_at == null): ?>
                                                <a class="  items-center gap-2 text-warning"
                                                    href="<?php echo e(route('farmer.edit', $user->id)); ?>">
                                                    <i class="fas fa-edit text-2xl px-2"></i>
                                                </a>
                                                <form id="deleteForm" method="POST"
                                                    class="items-center gap-2 text-warning"
                                                    action="<?php echo e(route('farmer.destroy', $user->id)); ?>"
                                                    style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button"
                                                        class="flex items-center gap-2 text-error "><i type="button"
                                                            class="fa-solid fa-trash text-2xl px-2 delete-button"></i></button>
                                                </form>
                                            <?php else: ?>
                                                <form id="deleteForm" method="POST"
                                                    class="items-center gap-2 text-warning"
                                                    action="<?php echo e(route('farmer.restore', $user->id)); ?>"
                                                    style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button"
                                                        class="flex items-center gap-2 text-error "><i type="button"
                                                            class="fa-solid fa-undo text-2xl px-2 restore-button"></i></button>
                                                </form>
                                            <?php endif; ?>
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
            function active_active_button(id, count) {

                let input = document.getElementById(`active_inactive_${count}`);

                let active_value; // Initialize variable without assigning an invalid value
                if (input.checked === true) {
                    active_value = "active";
                } else {
                    active_value = "inactive";
                }

                // console.log(active_value);

                $.ajax({
                    url: "<?php echo e(url('change-farmer-status')); ?>",
                    method: "POST",
                    data: {
                        user_id: id,
                        status: active_value,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(res) {
                        if (res.status === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message, // Message comes from controller
                                timer: 3000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: res.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: "Something went wrong! Please try again.",
                            timer: 3000,
                            showConfirmButton: false
                        });
                        console.error(xhr.responseText);
                    }
                });

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




        <script>
            document.addEventListener('alpine:init', () => {
                // Initialize DataTables
                let dt = new DataTable("#farmer_Table", {
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
                                    title: "KisanSat (Farmer Details)",

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6
                                        ],
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Farmer Details)',

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6,
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farmer\index.blade.php ENDPATH**/ ?>