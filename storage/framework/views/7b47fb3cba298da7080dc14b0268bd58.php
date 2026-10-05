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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Farms')]); ?>
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

    <div class="mt-5">


        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">

            <div class="mb-14 w-full p-7" x-data="{
                openTab: 1,
                activeClasses: 'text-primary border-primary',
                inactiveClasses: 'border-transparent',
            }">
                <div class="border-stroke dark:border-strokedark mb-6 flex flex-wrap gap-5 border-b sm:gap-10">
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 1" :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Farms
                    </a>
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses">
                        Farm Monitoring
                    </a>

                </div>
                <div>
                    <div class="font-medium leading-relaxed" x-show="openTab === 1">
                        <div class="text-end">
                            
                        </div>

                        <div class="mb-14 w-full p-7" x-data="{
                            openTab: 1,
                            activeClasses: 'text-primary border-primary',
                            inactiveClasses: 'border-transparent',
                        }">
                            <div
                                class="border-stroke dark:border-strokedark mb-6 flex flex-wrap gap-5 border-b sm:gap-10">
                                <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base"
                                    href="#" @click.prevent="openTab = 1"
                                    :class="openTab === 1 ? activeClasses : inactiveClasses">
                                    Paid Farms
                                </a>
                                <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base"
                                    href="#" @click.prevent="openTab = 2"
                                    :class="openTab === 2 ? activeClasses : inactiveClasses">
                                    UnPaid Farms
                                </a>

                            </div>

                            <div class="font-medium leading-relaxed" x-show="openTab === 1">


                                <table class="table" id="paidFarm_Table">
                                    <thead class="text-primary-content">
                                        <tr>
                                            <th>#</th>
                                            <th>Farm ID</th>
                                            <th>Farm Name</th>
                                            <th>Farmer Name</th>
                                            <th>Farm Area</th>
                                            <th>Coordinates</th>
                                            <th>Crop Type</th>
                                            <th>Crop Variety</th>
                                            
                                            
                                            <th>Sowing Date</th>
                                            <th>Subscription ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $paid_farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="<?php echo e($data->farm_deleted_at !== null ? '!bg-red-200' : ''); ?>">
                                                
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($data->farm_id); ?></td>
                                                <td>
                                                    <a class="hover:underline"
                                                        href="<?php echo e(route('addfarm.show', $data->farmid)); ?>">
                                                        <?php echo e($data->farm_name); ?>

                                                    </a>
                                                    <?php if($data->farm_status === 'Paid'): ?>
                                                        <span class="badge badge-secondary badge-sm">Paid</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a class="hover:underline"
                                                        href="<?php echo e(route('farmer.show', $data->user_id)); ?>">
                                                        <?php echo e($data->user_name); ?>

                                                    </a>
                                                </td>
                                                
                                                <td><?php echo e(floor($data->area * 10) / 10); ?> Acre</td>

                                                <td>
                                                    <!-- Button to Open Modal -->
                                                    <button class="btn btn-primary btn-sm px-5"
                                                        onclick="fetchFarmData(<?php echo e($data->farmid); ?>, 'farmer_modal_<?php echo e($data->farmid); ?>')">
                                                        <i class="fa-solid fa-location-dot text-white"></i>
                                                    </button>


                                                    <!-- Large Modal -->
                                                    <dialog class="modal" id="farmer_modal_<?php echo e($data->farmid); ?>">
                                                        <div class="modal-box w-11/12 max-w-6xl">
                                                            <h3 class="text-lg font-bold">Coordinates Details</h3>
                                                            <div class="overflow-x-auto">
                                                                <table
                                                                    class="table mt-4 w-full border-collapse border border-gray-300">
                                                                    <thead>
                                                                        <tr class="bg-gray-200">
                                                                            <th class="border p-2">#</th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Farm ID
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Farm Name
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Farmer
                                                                                Name
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Center
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Coordinates
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="farmer_data_<?php echo e($data->farmid); ?>">
                                                                        <!-- Data will be inserted here dynamically -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-action">
                                                                <button class="btn"
                                                                    onclick="document.getElementById('farmer_modal_<?php echo e($data->farmid); ?>').close()">Close</button>
                                                            </div>
                                                        </div>
                                                    </dialog>
                                                </td>
                                                <td><?php echo e(ucfirst($data->croptype)); ?></td>
                                                <td><?php echo e(empty($data->crop_variety) ? 'N/A' : $data->crop_variety); ?></td>
                                                
                                                
                                                <td><?php echo e(date('d-M-Y', strtotime($data->sowingdate))); ?></td>
                                                <td><?php echo e($data->subscription_code ?? 'N/A'); ?></td>
                                                <?php if($data->farm_deleted_at == null): ?>
                                                    <td>Active</td>
                                                <?php else: ?>
                                                    <td>Inactive</td>
                                                <?php endif; ?>
                                                


                                                <td class="flex" style="height: 65px">
                                                    <a class="items-center gap-2 text-info"
                                                        href="<?php echo e(route('addfarm.show', $data->farmid)); ?>">
                                                        <i class="fas fa-eye px-2 text-2xl"></i>
                                                    </a>
                                                    <?php if($data->farm_deleted_at == null): ?>
                                                        <form class="items-center gap-2 text-warning" id="deleteForm"
                                                            style="display:inline;" method="POST"
                                                            action="<?php echo e(route('addfarm.destroy', $data->farmid)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button class="flex items-center gap-2 text-error"
                                                                type="button"><i
                                                                    class="fa-solid fa-trash delete-button px-2 text-2xl"
                                                                    type="button"></i></button>
                                                        </form>
                                                    <?php else: ?>
                                                        <form class="items-center gap-2 text-warning" id="deleteForm"
                                                            style="display:inline;" method="POST"
                                                            action="<?php echo e(route('addfarm.restore', $data->farmid)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button class="flex items-center gap-2 text-error"
                                                                type="button"><i
                                                                    class="fa-solid fa-undo restore-button px-2 text-2xl"
                                                                    type="button"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>

                                                

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="font-medium leading-relaxed" x-show="openTab === 2">


                                <table class="table" id="UnpaidFarm_Table">
                                    <thead class="text-primary-content">
                                        <tr>
                                            <th>#</th>
                                            <th>Farm ID</th>
                                            <th>Farm Name</th>
                                            <th>Farmer Name</th>
                                            <th>Farm Area</th>
                                            <th>Coordinates</th>
                                            <th>Crop Type</th>
                                            <th>Crop Variety</th>
                                            
                                            
                                            <th>Sowing Date</th>
                                            
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $unpaid_farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="<?php echo e($data->farm_deleted_at !== null ? '!bg-red-200' : ''); ?>">
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($data->farm_id); ?></td>
                                                <td>
                                                    <a class="hover:underline"
                                                        href="<?php echo e(route('addfarm.show', $data->farmid)); ?>">
                                                        <?php echo e($data->farm_name); ?>

                                                    </a>
                                                    <?php if($data->farm_status === 'Paid'): ?>
                                                        <span class="badge badge-secondary badge-sm">Paid</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a class="hover:underline"
                                                        href="<?php echo e(route('farmer.show', $data->user_id)); ?>">
                                                        <?php echo e($data->user_name); ?>

                                                    </a>
                                                </td>
                                                <td><?php echo e(floor($data->area * 10) / 10); ?> Acre</td>


                                                <td>
                                                    <!-- Button to Open Modal -->
                                                    <button class="btn btn-primary btn-sm px-5"
                                                        onclick="fetchFarmData(<?php echo e($data->farmid); ?>, 'farmer_modal_<?php echo e($data->farmid); ?>')">
                                                        <i class="fa-solid fa-location-dot text-white"></i>
                                                    </button>


                                                    <!-- Large Modal -->
                                                    <dialog class="modal" id="farmer_modal_<?php echo e($data->farmid); ?>">
                                                        <div class="modal-box w-11/12 max-w-6xl">
                                                            <h3 class="text-lg font-bold">Coordinates Details</h3>
                                                            <div class="overflow-x-auto">
                                                                <table
                                                                    class="table mt-4 w-full border-collapse border border-gray-300">
                                                                    <thead>
                                                                        <tr class="bg-gray-200">
                                                                            <th class="border p-2">#</th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Farmer ID
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Farm Name
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Farmer
                                                                                Name
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Center
                                                                            </th>
                                                                            <th class="whitespace-nowrap border p-2">
                                                                                Coordinates
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="farmer_data_<?php echo e($data->farmid); ?>">
                                                                        <!-- Data will be inserted here dynamically -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-action">
                                                                <button class="btn"
                                                                    onclick="document.getElementById('farmer_modal_<?php echo e($data->farmid); ?>').close()">Close</button>
                                                            </div>
                                                        </div>
                                                    </dialog>
                                                </td>
                                                <td><?php echo e(ucfirst($data->croptype)); ?></td>
                                                <td><?php echo e(empty($data->crop_variety) ? 'N/A' : $data->crop_variety); ?></td>
                                                
                                                
                                                <td><?php echo e(date('d-M-Y', strtotime($data->sowingdate))); ?></td>
                                                
                                                <?php if($data->farm_deleted_at == null): ?>
                                                    <td>Active</td>
                                                <?php else: ?>
                                                    <td>Inactive</td>
                                                <?php endif; ?>
                                                




                                                <td class="flex" style="height: 65px">
                                                    <a class="items-center gap-2 text-info"
                                                        href="<?php echo e(route('addfarm.show', $data->farmid)); ?>">
                                                        <i class="fas fa-eye px-2 text-2xl"></i>
                                                    </a>
                                                    <?php if($data->farm_deleted_at == null): ?>
                                                        <form class="items-center gap-2 text-warning" id="deleteForm"
                                                            style="display:inline;" method="POST"
                                                            action="<?php echo e(route('addfarm.destroy', $data->farmid)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button class="flex items-center gap-2 text-error"
                                                                type="button"><i
                                                                    class="fa-solid fa-trash delete-button px-2 text-2xl"
                                                                    type="button"></i></button>
                                                        </form>
                                                    <?php else: ?>
                                                        <form class="items-center gap-2 text-warning" id="deleteForm"
                                                            style="display:inline;" method="POST"
                                                            action="<?php echo e(route('addfarm.restore', $data->farmid)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button class="flex items-center gap-2 text-error"
                                                                type="button"><i
                                                                    class="fa-solid fa-undo restore-button px-2 text-2xl"
                                                                    type="button"></i></button>
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
                    <div class="font-medium leading-relaxed" x-show="openTab === 2">

                        <table class="table" id="Monitoring_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    
                                    <th>Farmer Name</th>
                                    <th>Total Farms</th>
                                    <th>Total Farm Area</th>
                                    <th>Total Subscriptions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        
                                        <td><?php echo e($data->name); ?></td>
                                        <td x-data="{ loading: false, farms: [] }">
                                            <button class="btn btn-ghost text-secondary underline"
                                                @click="
													loading = true;
													farms = <?php echo e($data->farms->toJson()); ?>; 
													$dispatch('open-modal', 'user_farms_modal_<?php echo e($data->id); ?>');
													loading = false;
												">
                                                <?php echo e($data->farms_count); ?>

                                            </button>

                                            <!-- Modal -->
                                            <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'user_farms_modal_'.e($data->id).'','maxWidth' => '7xl','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_farms_modal_'.e($data->id).'','maxWidth' => '7xl','focusable' => true]); ?>
                                                <div class="overflow-x-auto p-4">
                                                    <h3 class="text-lg font-bold">Farm Details</h3>
                                                    <table
                                                        class="table mt-4 w-full border-collapse border border-gray-300">
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th class="border p-2">#</th>
                                                                <th class="border p-2">View</th>
                                                                <th class="border p-2">Farm ID</th>
                                                                <th class="border p-2">Farm Name</th>
                                                                <th class="border p-2">Crop Type</th>
                                                                
                                                                <th class="border p-2">Crop Variety</th>
                                                                <th class="border p-2">Sowing Date</th>
                                                                <th class="border p-2">Location</th>
                                                                <th class="border p-2">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="overflow-y-scroll">
                                                            <template x-for="(farm, index) in farms"
                                                                :key="farm.id">
                                                                
                                                                <tr>
                                                                    <td class="border p-2" x-text="index + 1"></td>
                                                                    <td class="border p-2"
                                                                        style="text-align: center !important;">
                                                                        <a :href="`/farm-monitoring/${farm.farm_id}/${farm.croptype}`"
                                                                            target="_blank" rel="noopener noreferrer">
                                                                            <i class="fa-regular fa-eye text-2xl"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td class="border p-2" x-text="farm.farm_id"></td>
                                                                    <td class="border p-2" x-text="farm.name"></td>
                                                                    <td class="border p-2" x-text="farm.croptype">
                                                                    </td>
                                                                    
                                                                    <td class="border p-2"
                                                                        x-text="farm.crop_variety ?? 'N/A' ">
                                                                    </td>
                                                                    
                                                                    

                                                                    <td class="border p-2"
                                                                        x-text="(() => {
                                                                            if (!farm.sowingdate) return 'N/A';

                                                                            let parts = farm.sowingdate.split('-'); // ['10', '04', '2025']
                                                                            if (parts.length !== 3) return 'N/A';

                                                                            let formattedDate = new Date(`${parts[2]}-${parts[1]}-${parts[0]}`); // yyyy-mm-dd
                                                                            if (isNaN(formattedDate)) return 'N/A';

                                                                            return formattedDate.toLocaleDateString('en-GB', {
                                                                                day: '2-digit',
                                                                                month: 'short',
                                                                                year: 'numeric'
                                                                            }).replace(/\s/g, '-');
                                                                        })()">
                                                                    </td>


                                                                    <td class="border p-2"
                                                                        x-text="`${farm.district}, ${farm.state}`">
                                                                    </td>
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
                                        <td><?php echo e(floor($data->farms_sum_area * 10) / 10); ?> Acre</td>

                                        <td><a class="text-secondary underline"
                                                href="<?php echo e(route('subscription.index')); ?>" target="_blank"
                                                rel="noopener noreferrer"><?php echo e($data->farms_with_subscriptions_count); ?></a>
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
            function farm_active_button(id, count) {

                let input = document.getElementById(`active_inactive_${count}`);

                let active_value; // Initialize variable without assigning an invalid value
                if (input.checked === true) {
                    active_value = "active";
                } else {
                    active_value = "inactive";
                }

                // console.log(active_value);

                $.ajax({
                    url: "<?php echo e(url('change-farm-status')); ?>",
                    method: "POST",
                    data: {
                        farm_id: id,
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


            function fetchFarmData(userId, modalId) {
                const modal = document.getElementById(modalId);
                modal.showModal();

                document.getElementById('farmer_data_' + userId).innerHTML = `
        <tr>
            <td colspan="6" class="text-center p-4">Loading...</td>
        </tr>`;

                fetch(`/get-farm-data/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('farmer_data_' + userId);
                        if (data.length === 0) {
                            tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center p-4 text-error">No data found.</td>
                    </tr>`;
                            return;
                        }

                        let html = "";
                        data.forEach((farmer, index) => {
                            html += `
                <tr>
                    <td class="border p-2 whitespace-nowrap">${index + 1}</td>
                    <td class="border p-2 whitespace-nowrap">${farmer.farm_id}</td>
                    <td class="border p-2 whitespace-nowrap">${farmer.farm_name}</td>
                    <td class="border p-2 whitespace-nowrap">${farmer.user_name}</td>
                    <td class="border p-2 whitespace-nowrap">[${farmer.center}]</td>
                    <td class="border p-2 whitespace-nowrap">[${farmer.geo_json.geometry.coordinates ?? 'N/A'}]</td>
                </tr>`;
                        });

                        tbody.innerHTML = html;
                    })
                    .catch(error => {
                        console.error("Error fetching farmer data:", error);
                        document.getElementById('farmer_data_' + userId).innerHTML = `
                <tr>
                    <td colspan="6" class="text-center p-4 text-error">Failed to load data.</td>
                </tr>`;
                    });
            }
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
            document.addEventListener('alpine:init', () => {
                let dt = new DataTable("#Monitoring_Table", {

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
                                // {
                                //     extend: "excel",
                                //     text: "Excel",
                                //     title: "KisanSat (Farm Monitoring Details)",

                                //     exportOptions: {
                                //         columns: [
                                //             0, 1, 3, 4,
                                //         ],
                                //     },
                                // },
                                // {
                                //     extend: 'print',
                                //     text: 'Print',
                                //     title: 'KisanSat (Farm Monitoring Details)',

                                //     exportOptions: {
                                //         columns: [
                                //             0, 1, 3, 4,
                                //         ],
                                //     },
                                //     customize: function(win) {
                                //         $(win.document.body).find('h1').css('text-align', 'center');
                                //     }
                                // }
                            ],
                        },
                    },

                });
            });
            // $(document).ready(function() {
            document.addEventListener('alpine:init', () => {
                // Initialize DataTables
                let dt = new DataTable("#paidFarm_Table", {
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    paging: true,
                    scrollX: true,
                    scrollY: "550px",
                    scrollCollapse: false,
                    autoWidth: false,
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
                                    title: "KisanSat (Paid Farms Details)",

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6, 7, 8, 9, 10
                                        ],
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Paid Farms Details)',

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6, 7, 8, 9, 10
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
            // $(document).ready(function() {
            document.addEventListener('alpine:init', () => {
                // Initialize DataTables
                let dt = new DataTable("#UnpaidFarm_Table", {
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    paging: true,
                    scrollX: true,
                    scrollY: "550px",
                    scrollCollapse: false,
                    autoWidth: false,
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
                                    title: "KisanSat (UnPaid Farms Details)",

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6, 7, 8, 9,
                                        ],
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (UnPaid Farms Details)',

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6, 7, 8, 9,
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farm\index.blade.php ENDPATH**/ ?>