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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Update Farmer Subscription Details'))]); ?>
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

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>


    <div class=" mt-5">
        <form method="POST" action="<?php echo e(route('subscription.update', $userId)); ?>">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Farmer Subscription Details</h4>
                </div>

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="grid grid-cols-2 gap-4 p-5">
                    <div class="form-control mb-4">
                        <input type="hidden" value="<?php echo e($uniq_id); ?>" name="uniq_id">
                        <?php $__currentLoopData = $old_farIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_farId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" value="<?php echo e($old_farId); ?>" name="old_farm_id[]">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <label class="label">
                            <span class="label-text">Farmer<span class="text-red-500">*</span></span>
                        </label>
                        <select name="user_id" id="select_farmer" class="select select-bordered w-full"
                            onchange="get_farmer_data(this.value)" required readonly>
                            <option value="" disabled <?php echo e(old('user_id', $user->id ?? '') ? '' : 'selected'); ?>>
                                Select Farmer
                            </option>

                            
                            <option value="<?php echo e($user->id); ?>" selected>
                                <?php echo e($user->name); ?>

                            </option>

                            
                            
                        </select>

                        <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" id="farmer_email"
                            value="<?php echo e(old('email', $user->email ?? '')); ?>" placeholder="Enter your email"
                            class="input input-bordered w-full" readonly>

                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Mobile No. </span>
                        </label>
                        <input type="tel" name="mobile" id="farmer_mobile"
                            value="<?php echo e(old('mobile', $user->mobile ?? '')); ?>" class="input input-bordered w-full"
                            pattern="[0-9]{10}" oninput="validateMobile(this)" maxlength="10"
                            placeholder="Enter 10-digit mobile number" readonly>
                        <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span> 
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Subscription Date <span class="text-red-500">*</span></span>
                        </label>
                        <input type="date" name="subscription_date"
                            
                             value="<?php echo e(old('subscription_date', isset($lastUpdatedDate) ? \Carbon\Carbon::parse($lastUpdatedDate)->format('Y-m-d') : '')); ?>"
                            class="input input-bordered w-full" required>

                        <?php $__errorArgs = ['subscription_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>


                </div>

                <div class="p-5">


                    <div class="pd-20 card-box height-100-p">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-xl font-semibold">Subscription</h4>
                            
                        </div>


                        <div class="form-control mb-4" style="overflow-x: scroll">
                            <table class="col-md-4 col-sm-4 col-xl-12 table" style="margin-bottom: 50px">
                                <thead>
                                    <tr>
                                        <th>Farm ID<span class="text-red-500">*</span></th>
                                        <th>Farm Area </th>
                                        <th style="max-width: 100%">Subscription Type<span class="text-red-500">*</span>
                                        </th>
                                        <th>Subscription Name<span class="text-red-500">*</span></th>
                                        <th>Subscription Duration</th>
                                        <th>Amount<span class="text-red-500">*</span></th>
                                        <th>Payment Status <span class="text-red-500">*</span></th>
                                        <th>Service Status <span class="text-red-500">*</span></th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">

                                </tbody>
                            </table>


                            <script>
                                var lastItemId = 0; // Initial Item ID

                                // console.log(lastItemId);

                                function fetchrow() {


                                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                        var table = document.getElementById("myTable");

                                        var newRow = table.insertRow(table.rows.length);
                                        var cell1 = newRow.insertCell(0);
                                        var cell2 = newRow.insertCell(1);
                                        var cell3 = newRow.insertCell(2);
                                        var cell4 = newRow.insertCell(3);
                                        var cell5 = newRow.insertCell(4);
                                        var cell6 = newRow.insertCell(5);
                                        var cell7 = newRow.insertCell(6);
                                        var cell8 = newRow.insertCell(7);
                                        var cell9 = newRow.insertCell(8);
                                        var cell10 = newRow.insertCell(9);


                                        cell1.innerHTML = `
                                        <select class="select select-bordered w-full farm-id-input" name="farm_id[]" id="farm_id_${lastItemId}" 
                                            onchange="get_farm_area_(this, ${lastItemId})" 
                                            style="height: 45px !important; width: 300px;">
                                            <option value="" disabled>Select Farm ID</option>
                                            <option value="<?php echo e($subscription->farms->farm_id); ?>" selected><?php echo e($subscription->farms->farm_id); ?>  <?php echo e($subscription->farms->name); ?></option>
                                        </select>
                                    `;

                                        cell2.innerHTML =
                                            `<input type="text" class="input input-bordered w-full" id="farm_area_${lastItemId}" style=" width: 110px;" value="<?php echo e(floor($subscription->farms->area * 10) / 10); ?>" readonly>`;

                                        cell3.innerHTML = `
                                        <select class="select select-bordered w-full" name="subscribable_type[]"   
                                            id="subscription_type_${lastItemId}" 
                                            onchange="get_subscription_name(this, ${lastItemId})"
                                            style="height: 45px !important; width: 200px;" required>
                                            <option value="package" <?php echo e($subscription->subscribable_type == 'App\Models\PackageMasterModel' ? 'selected' : ''); ?>>Packages</option>
                                            <option value="premium service" <?php echo e($subscription->subscribable_type == 'App\Models\ServiceMasterModel' ? 'selected' : ''); ?>>Premium Services</option>
                                        </select>
                                    `;

                                        cell4.innerHTML = `
                                        <select name="subscription_id[]" class="select select-bordered w-full" 
                                            style="height: 45px !important; width: 200px;" 
                                            onchange="get_duration_name(this, ${lastItemId}); check_dupplicate_data(${lastItemId}); dupplicate_row_data(${lastItemId});sub_validation_row_data(${lastItemId}); check_existing_subscription(${lastItemId})"                                            id="subscription_name_${lastItemId}" required>
                                            <option value="<?php echo e($subscription->subscribable_id); ?>" selected ><?php echo e($subscription->subscribable_name); ?></option>
                                        </select>
                                    `;

                                        cell5.innerHTML =
                                            `<input type="text" id="duration_${lastItemId}" class="input input-bordered w-full" style="  width: 200px" value="<?php echo e($subscription->sub_duration); ?>" readonly>`;

                                        cell6.innerHTML =
                                            `<input type="text" pattern="^\\d+(\\.\\d{0,2})?$" oninput="validateDecimal(this); amount_calculation(${lastItemId})" id="subscription_amount_${lastItemId}"
                                             name="amount[]" class="input input-bordered w-full" style="  width: 201px" value="<?php echo e($subscription->amount); ?>" required>`;

                                        cell7.innerHTML = `
                                        <select class="select select-bordered w-full" name="payment_status[]" style="height: 45px !important; width: 150px;" required>
                                            
                                                <option value="completed" <?php echo e($subscription->payment_status == 'completed' ? 'selected' : ''); ?>>Completed</option>
                                               
                                                <option value="cancelled" <?php echo e($subscription->payment_status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                                
                                        </select>
                                    `;

                                        cell8.innerHTML =
                                            `
                                        <select class="select select-bordered w-full" name="subscription_status[]"
                                       id="service_status_${lastItemId}"   
                                                style="height: 45px !important; width: 200px;" 
                                                 required>
                                                <option value="" disabled>Select Subscription Status</option>
                                                <option value="active" <?php echo e($subscription->status == 'active' ? 'selected' : ''); ?>>Active</option>
                                                <option value="inactive" <?php echo e($subscription->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                                <option value="expired" <?php echo e($subscription->status == 'expired' ? 'selected' : ''); ?>>Expired</option>

                                            </select>
                                        `
                                        cell9.innerHTML =
                                            `<button class="btn btn-success" onclick="addRow(event); get_farm_data_in_button(lastItemId)"><i class="fa-solid fa-plus text-white text-bold"></i></button>`;

                                        if (lastItemId !== 0) {
                                            <?php if($subscription->status !== 'active'): ?>
                                                <?php if($subscription->status !== 'expired'): ?>
                                                    cell10.innerHTML =
                                                        `<button class="btn btn-error" onclick="deleteRow(this)"><i class="fas fa-minus-circle text-white text-bold"></i></button>`;
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        }
                                        // ✅ If status is active, disable all fields in this row
                                        setTimeout(() => {
                                            let table = document.getElementById("myTable");
                                            let rows = table.rows; // Get all rows from the table

                                            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($subscription->status === 'active' || $subscription->status === 'expired'): ?>
                                                    if (rows[<?php echo e($index); ?>]) {
                                                        rows[<?php echo e($index); ?>].querySelectorAll("input").forEach((element) => {
                                                            element.setAttribute("readonly", true); // ✅ Set readonly
                                                            element.style.backgroundColor =
                                                                "#e9ecef"; // Optional: Light gray background
                                                        });

                                                        rows[<?php echo e($index); ?>].querySelectorAll("select").forEach((element) => {
                                                            element.style.pointerEvents = "none"; // ✅ Disable selection
                                                            element.style.backgroundColor =
                                                                "#e9ecef"; // Optional: Light gray background
                                                        });
                                                    }
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        }, 100);



                                        lastItemId++;
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                }


                                function addRow(event) {
                                    event.preventDefault();
                                    var table = document.getElementById("myTable");
                                    var newRow = table.insertRow(table.rows.length);

                                    var cell1 = newRow.insertCell(0);
                                    var cell2 = newRow.insertCell(1);
                                    var cell3 = newRow.insertCell(2);
                                    var cell4 = newRow.insertCell(3);
                                    var cell5 = newRow.insertCell(4);
                                    var cell6 = newRow.insertCell(5);
                                    var cell7 = newRow.insertCell(6);
                                    var cell8 = newRow.insertCell(7);
                                    var cell9 = newRow.insertCell(8);
                                    var cell10 = newRow.insertCell(9);
                                    var cell11 = newRow.insertCell(10);
                                    var cell12 = newRow.insertCell(11);
                                    var cell13 = newRow.insertCell(12);

                                    cell1.innerHTML =
                                        `
                                                <select class="select select-bordered w-full farm-id-input farmid_select" name="farm_id[]" id="farm_id_${lastItemId}" onchange="get_farm_area_(this, ${lastItemId})" style="height: 45px !important; width: 300px;" placeholder="Farm ID" required>
                                                    <option value="" selected disabled>Select Farm ID</option>
                                                </select>
                                                 `;
                                    $(".farmid_select").select2();

                                    cell2.innerHTML =
                                        `
                                        <input type="text"  class="input input-bordered w-full" id="farm_area_${lastItemId}" style=" width: 110px;" placeholder="Farm Area" readonly>
                                        `;

                                    cell3.innerHTML =
                                        `
                                            <select class="select select-bordered w-full" name="subscribable_type[]"   
                                                id="subscription_type_${lastItemId}" 
                                                onchange="get_subscription_name(this, ${lastItemId})"
                                                style="height: 45px !important; width: 200px;" 
                                                  required>
                                                <option value="" selected disabled>Select Subscription Type</option>
                                                <option value="package">Packages</option>
                                                <option value="premium service">Premium Services</option>
                                            </select>
                                         `;
                                    // $('[id^="subscription_type_"]').select2();

                                    cell4.innerHTML =
                                        `
                                        <select name="subscription_id[]" class="select select-bordered w-full" 
                                            style="height: 45px !important; width: 200px;" 
                                            onchange="get_duration_name(this, ${lastItemId}); check_dupplicate_data(${lastItemId}); dupplicate_row_data(${lastItemId});sub_validation_row_data(${lastItemId}); check_existing_subscription(${lastItemId})"                                            id="subscription_name_${lastItemId}" required>
                                            id="subscription_name_${lastItemId}" 
                                            required >
                                            <option value="" selected>Subscription Name</option>
                                        </select>
                                        `;

                                    cell5.innerHTML =
                                        `<input type="text" step="any" id="duration_${lastItemId}"  class="input input-bordered w-full" style="  width: 200px" placeholder="Duration"  readonly>`;

                                    cell6.innerHTML =
                                        `<input type="text" 
                                          oninput="validateDecimal(this); amount_calculation(${lastItemId})" id="subscription_amount_${lastItemId}"
                                           name="amount[]" class="input input-bordered w-full" style="  width: 201px" placeholder="Amount"  required>`;

                                    cell7.innerHTML =
                                        `
                                       <select class="select select-bordered w-full" name="payment_status[]"   
                                                style="height: 45px !important; width: 150px;" 
                                                 required>
                                                <option value="" selected disabled>Select Payment Status</option>
                                               
                                                <option value="completed">Completed</option>
 
                                                <option value="cancelled">Cancelled</option>
                                               
                                            </select>
                                        
                                        `;
                                    cell8.innerHTML =
                                        `
                                        <select class="select select-bordered w-full" name="subscription_status[]"
                                       id="service_status_${lastItemId}"   
                                                style="height: 45px !important; width: 200px;" 
                                                 required>
                                                <option value="" selected disabled>Select Subscription Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        `

                                    cell9.innerHTML =
                                        `<button class="btn btn-success" onclick="addRow(event); get_farm_data_in_button(lastItemId)"><i class="fa-solid fa-plus text-white text-bold"></i></button>`;
                                    if (lastItemId !== 0) {
                                        cell10.innerHTML =
                                            `<button class="btn btn-error" onclick="deleteRow(this)"><i class="fas fa-minus-circle text-white text-bold"></i></button>`;
                                    }

                                    lastItemId++;
                                }


                                function deleteRow(button) {
                                    var row = button.parentNode.parentNode;
                                    var table = document.getElementById("myTable");
                                    var rowIndex = row.rowIndex;

                                    row.parentNode.removeChild(row);
                                    lastItemId--;

                                    amount_calculation();

                                }
                            </script>
                        </div>
                    </div>

                </div>


                <div class="w-1/2 p-5 ml-auto">
                    <div class="w-full">
                        <h5 class="text-xl font-semibold">Payment Details</h5>

                        <!-- Total Amount -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Total Amount <span class="text-red-500">*</span></span>
                            </label>
                            <input type="text" id="total_amount" name="total_amount"
                                class="input input-bordered w-full" value="0" placeholder="Total Amount" readonly>
                        </div>

                        <!-- Payment Mode -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Payment Mode <span class="text-red-500">*</span></span>
                            </label>
                            <select class="select select-bordered w-full" name="payment_mode" required>
                                <option value="upi" <?php echo e($payment->payment_method == 'upi' ? 'selected' : ''); ?>>UPI
                                </option>
                                <option value="bank transfer"
                                    <?php echo e($payment->payment_method == 'bank transfer' ? 'selected' : ''); ?>>Bank Transfer
                                </option>
                                <option value="card" <?php echo e($payment->payment_method == 'card' ? 'selected' : ''); ?>>Card
                                </option>
                                <option value="cash" <?php echo e($payment->payment_method == 'cash' ? 'selected' : ''); ?>>Cash
                                </option>
                                <option value="other" <?php echo e($payment->payment_method == 'other' ? 'selected' : ''); ?>>
                                    Other
                                </option>
                            </select>

                        </div>

                        <!-- Payment Status -->
                        <!--<div class="form-control mb-4">-->
                        <!--    <label class="label">-->
                        <!--        <span class="label-text">Payment Status <span class="text-red-500">*</span></span>-->
                        <!--    </label>-->
                        <!--    <select class="select select-bordered w-full" name="status" required>-->
                        <!--        <option value="pending" <?php echo e($payment->status == 'pending' ? 'selected' : ''); ?>>Pending-->
                        <!--        </option>-->
                        <!--        <option value="paid" <?php echo e($payment->status == 'paid' ? 'selected' : ''); ?>>Paid-->
                        <!--        </option>-->
                        <!--        <option value="other" <?php echo e($payment->status == 'other' ? 'selected' : ''); ?>>-->
                        <!--            Other-->
                        <!--        </option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!-- Transaction ID -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Transaction ID </span>
                            </label>
                            <input type="text" name="transaction_id" value="<?php echo e($payment->transaction_id); ?>"
                                class="input input-bordered w-full" placeholder="Transaction ID">
                        </div>

                        <!-- Remarks -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Remarks</span>
                            </label>
                            <textarea name="remark" class="textarea textarea-bordered w-full" rows="5" cols="10"
                                placeholder="Enter Remarks"><?php echo e(old('remark', $subscription->remark)); ?></textarea>
                            <?php $__errorArgs = ['remark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="<?php echo e(route('subscription.index')); ?>" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>
    

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchrow();
            amount_calculation();
        });
        // for amount input

        function validateDecimal(input) {
            // Only allow numbers with up to 2 decimal places
            input.value = input.value.replace(/[^0-9.]/g, '') // Allow only numbers and dot
                .replace(/(\..*)\./g, '$1') // Prevent multiple dots
                .replace(/^0+(?=\d)/, '') // Prevent leading zeros
                .match(/^\d*(\.\d{0,2})?/g)?.[0] || ''; // Restrict to 2 decimals
        }


        // get farm data 

        function get_farmer_data(id) {
            // console.log("Selected Farmer ID:", id);

            $.ajax({
                url: "<?php echo e(url('farmer-subscription_get-farmer-data')); ?>",
                method: "POST",
                data: {
                    user_id: id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(res) {
                    // console.log("Response:", res);
                    $('#farmer_email').val(res.farmer_data.email);
                    $('#farmer_mobile').val(res.farmer_data.mobile);
                    // Check if response has farms data
                    if (res.farms && res.farms.length > 0) {
                        let dropdown = $(".farm-id-input");
                        dropdown.empty(); // Clear existing options
                        dropdown.append('<option value="" disabled selected>Select Farm ID</option>');

                        // Append new options
                        res.farms.forEach(farm => {
                            dropdown.append(
                                `<option value="${farm.farm_id}">${farm.farm_id} ${farm.name}</option>`
                            );
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No Farms Found!',
                            text: 'No farms are available for the selected farmer.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        });
                        uppar_inputs_value_remove_();

                    }
                },
                error: function(err) {
                    console.log(err);

                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops!',
                    //     text: 'Something went wrong.',
                    //     confirmButtonText: 'OK',
                    //     confirmButtonColor: '#d33'
                    // });
                }
            });
        }
        // get  farm from button data 

        function get_farm_data_in_button(last_id) {

            // console.log("Selected Farmer ID:", id);
            let actual_last_id = last_id - 1;
            let id = $('#select_farmer').val();

            // console.log(actual_last_id);

            $.ajax({
                url: "<?php echo e(url('farmer-subscription_get-farmer-data')); ?>",
                method: "POST",
                data: {
                    user_id: id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(res) {
                    // console.log("Response:", res);

                    // Check if response has farms data
                    if (res.farms && res.farms.length > 0) {
                        let dropdown = $("#farm_id_" + actual_last_id);
                        dropdown.empty(); // Clear existing options
                        dropdown.append('<option value="" disabled selected>Select Farm ID</option>');

                        // Append new options
                        res.farms.forEach(farm => {
                            dropdown.append(
                                `<option value="${farm.farm_id}">${farm.farm_id} ${farm.name}</option>`
                            );
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No Farms Found!',
                            text: 'No farms are available for the selected farmer.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                },
            });
        }

        // get farm data 

        function get_farm_area_(data, lastItemId) {
            // console.log(data.value, lastItemId);
            let item_last_id = lastItemId - 1;
            // console.log(item_last_id);

            $.ajax({
                url: "<?php echo e(url('get-farm-area')); ?>",
                method: "POST",
                data: {
                    farm_id: data.value,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                success: function(res) {
                    // console.log(res);

                    if (res.farms != null) {
                        // $('#farm_area_' + lastItemId).val(parseFloat(res.farms.area).toFixed(2));
                        let truncatedValue = Math.floor(res.farms.area * 10) / 10;
                        $('#farm_area_' + lastItemId).val(truncatedValue);


                        $('#subscription_type_' + lastItemId).val('');
                        $('#subscription_name_' + lastItemId).val('');
                        $('#duration_' + lastItemId).val('');
                        $('#subscription_amount_' + lastItemId).val('');
                        $('#subscription_payment_status_' + lastItemId).val('');
                        $('#service_status_' + lastItemId).val('');
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No data Found!',
                            text: 'No farms area available for the selected farm.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                },
                error: function(err) {
                    console.log(err);

                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops!',
                    //     text: 'Something went wrong.',
                    //     confirmButtonText: 'OK',
                    //     confirmButtonColor: '#d33'
                    // });
                }
            });
        }


        // for service data get 
        function get_subscription_name(selectElement, lastItemId) {
            // console.log(lastItemId);

            let selectedValue = selectElement.value;
            let uomSelect = document.getElementById(`subscription_name_${lastItemId}`);
            // console.log(uomSelect);

            // Pehle saare options hata do
            uomSelect.innerHTML = `<option value="" selected>Subscription Name</option>`;

            let values_id = [];
            let options = [];

            if (selectedValue === "package") {
                // options = ["Gold Package", "Silver Package", "Basic Package"];

                $.ajax({
                    url: "<?php echo e(url('get-package-data-from-master')); ?>",
                    method: "GET",
                    success: function(res) {
                        if (res.packages.length > 0) {
                            res.packages.forEach(package => {
                                let opt = document.createElement("option");
                                opt.value = package.id;
                                opt.textContent = package.name;
                                uomSelect.appendChild(opt);
                            });
                            $('#duration_' + lastItemId).val('');
                            $('#subscription_amount_' + lastItemId).val('');

                            $('#subscription_payment_status_' + lastItemId).val('');
                            $('#service_status_' + lastItemId).val('');

                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'No packages found.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while fetching packages.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            } else if (selectedValue === "premium service") {
                // let options = ["Crop Health", "Image Advisory", "Basic Package"];
                $.ajax({
                    url: "<?php echo e(url('get-service-data-from-master')); ?>",
                    method: "GET",
                    success: function(res) {
                        if (res.services.length > 0) {
                            res.services.forEach(service => {
                                let opt = document.createElement("option");
                                opt.value = service.id;
                                opt.textContent = service.name;
                                uomSelect.appendChild(opt);
                            });
                            $('#duration_' + lastItemId).val('');
                            $('#subscription_amount_' + lastItemId).val('');

                            $('#subscription_payment_status_' + lastItemId).val('');
                            $('#service_status_' + lastItemId).val('');
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'No services found.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while fetching services.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            } else if (selectedValue === "free service") {
                $.ajax({
                    url: "<?php echo e(url('get-freeservice-data-from-master')); ?>",
                    method: "GET",
                    success: function(res) {
                        if (res.freeservices.length > 0) {
                            res.freeservices.forEach(freeservice => {
                                let opt = document.createElement("option");
                                opt.value = freeservice.id;
                                opt.textContent = freeservice.name;
                                uomSelect.appendChild(opt);
                            });
                            $('#duration_' + lastItemId).val('');
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'No services found.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while fetching services.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            }
        }


        // for get duration name 
        function get_duration_name(selectElement, lastItemId) {
            let services_id = selectElement.value;

            // console.log(services_id);

            let subscriptiontype = document.getElementById(`subscription_type_${lastItemId}`);
            let subscriptiontype_value = subscriptiontype.value;
            // console.log(subscriptiontype_value);


            if (subscriptiontype_value === "package") {
                // options = ["Gold Package", "Silver Package", "Basic Package"];

                $.ajax({
                    url: "<?php echo e(url('get-packageduration-data-from-master')); ?>",
                    method: "POST",
                    data: {
                        package_id: services_id,
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(res) {
                        // console.log(res);

                        if (res.packagesduration != null) {
                            let durationText = res.packagesduration.duration_labels;

                            let area_val = $('#farm_area_' + lastItemId).val();
                            let actual_area = 0;

                            if (area_val >= 1) {
                                actual_area = $('#farm_area_' + lastItemId).val(); // Use actual input value
                            } else {
                                actual_area = 1; // Force minimum area to 1 if less than 1
                            }


                            let pack_amount = res.packagesduration.amount * actual_area;

                            // console.log(area_val, pack_amount, res.packagesduration.amount);


                            $('#duration_' + lastItemId).val(durationText);
                            $('#subscription_amount_' + lastItemId).val(parseFloat(pack_amount).toFixed(2));
                            amount_calculation();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'No packages duration found.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while fetching packages duration.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            } else if (subscriptiontype_value === "premium service") {
                // let options = ["Crop Health", "Image Advisory", "Basic Package"];
                $.ajax({
                    url: "<?php echo e(url('get-serviceduration-data-from-master')); ?>",
                    method: "POST",
                    data: {
                        services_id: services_id,
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(res) {
                        // console.log(res);



                        if (res.serviceduration && res.serviceduration.length > 0) {

                            let area_val = $('#farm_area_' + lastItemId).val();

                            let actual_area_pack = 0;

                            if (area_val >= 1) {
                                actual_area_pack = $('#farm_area_' + lastItemId)
                                    .val(); // Use actual input value
                            } else {
                                actual_area_pack = 1; // Force minimum area to 1 if less than 1
                            }

                            // console.log(area_val, pack_amount, res.amount);
                            let pack_amount = res.amount * actual_area_pack;


                            $('#duration_' + lastItemId).val(res.serviceduration.join(", "));
                            $('#subscription_amount_' + lastItemId).val(parseFloat(pack_amount).toFixed(2));
                            amount_calculation();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'No service duration found.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while fetching service duration.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            } else if (subscriptiontype_value === "free service") {
                $.ajax({
                    url: "<?php echo e(url('get-freeduration-data-from-master')); ?>",
                    method: "POST",
                    data: {
                        services_id: services_id,
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(res) {
                        // console.log(res);

                        if (res.freeserviceduration && res.freeserviceduration.length > 0) {
                            $('#duration_' + lastItemId).val(res.freeserviceduration.join(", "));

                            let area_val = $('#farm_area_' + lastItemId).val();
                            let actual_area_free = 0;

                            if (area_val >= 1) {
                                actual_area_free = $('#farm_area_' + lastItemId)
                                    .val(); // Use actual input value
                            } else {
                                actual_area_free = 1; // Force minimum area to 1 if less than 1
                            }

                            let pack_amount = res.amount * actual_area_free;

                            // console.log(area_val, pack_amount, res.packagesduration.amount);


                            $('#subscription_amount_' + lastItemId).val(parseFloat(pack_amount).toFixed(2));
                            amount_calculation();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'No free service duration found.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while fetching free service duration.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                });
            }
        }


        // for check dupplicate data

        function check_dupplicate_data(lastItemId) {
            let farmer_val = $('#select_farmer').val();
            let farm_val = $('#farm_id_' + lastItemId).val();
            let sub_type_val = $('#subscription_type_' + lastItemId).val();
            let sub_name_val = $('#subscription_name_' + lastItemId).val();
            // console.log(farm_val, sub_type_val, sub_name_val);

            $.ajax({
                url: "<?php echo e(url('dupplicate-subscritption-data')); ?>",
                method: "POST",
                data: {
                    farm_id: farm_val,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                success: function(res) {

                    if (res.subscriptions) {
                        let res_farm = res.subscriptions.farm_id;
                        let res_type_val = res.subscriptions.subscribable_type;
                        let res_name_val = res.subscriptions.subscribable_id;

                        // console.log(res_farm, res_type_val, res_name_val);

                        if (farm_val == res_farm && sub_type_val == res_type_val && sub_name_val ==
                            res_name_val) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'This service is already active in your farm.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                remove_inputs_value(lastItemId);
                            });

                            // Run the function immediately after triggering the alert
                            remove_inputs_value(lastItemId);
                        }
                    }
                },
                error: function() {
                    console.log('Error');
                }
            });
        }


        // for dupplicate row data 

        function dupplicate_row_data(lastItemId) {
            let current_farm_val = $('#farm_id_' + lastItemId).val();
            let current_sub_type_val = $('#subscription_type_' + lastItemId).val();
            let current_sub_name_val = $('#subscription_name_' + lastItemId).val();

            let isDuplicate = false; // Flag to check if duplicate is found

            // Loop through all existing rows to check for duplicates
            $('.farm-id-input').each(function() {
                let rowId = $(this).attr('id').split('_')[2]; // Extract row ID from element ID
                if (rowId != lastItemId) { // Exclude the current row being checked
                    let farm_val = $('#farm_id_' + rowId).val();
                    let sub_type_val = $('#subscription_type_' + rowId).val();
                    let sub_name_val = $('#subscription_name_' + rowId).val();

                    // Check if all three values match
                    if (farm_val == current_farm_val && sub_type_val == current_sub_type_val && sub_name_val ==
                        current_sub_name_val) {
                        isDuplicate = true;
                        return false; // Exit loop early if duplicate is found
                    }
                }
            });

            if (isDuplicate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Dupplicate entry found.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    remove_inputs_value(lastItemId);
                });

                remove_inputs_value(lastItemId); // Ensure fields are cleared
            }
        }

        // function sub_validation_row_data(lastItemId) {
        //     let current_farm_val = $('#farm_id_' + lastItemId).val();
        //     let current_sub_type_val = $('#subscription_type_' + lastItemId).val();
        //     let current_sub_name_val = parseInt($('#subscription_name_' + lastItemId).val()); // Convert to number if needed

        //     let check_current_gold_type_val = '';
        //     if (current_sub_type_val === package && current_sub_name_val === 4) {
        //         if (sub_type_val === 'package') {
        //             check_current_gold_type_val = 'gold';
        //         }
        //     }

        //     let basicExists = false;
        //     let goldExists = false;
        //     let SilverExists = false;
        //     let premiumExists = false;


        //     // Loop through only previous rows to check existing selections
        //     $('.farm-id-input').each(function() {
        //         let rowId = $(this).attr('id').split('_')[2];
        //         let run_time_type_val = $('#subscription_type_' + rowId).val();
        //         let sub_type_val = $('#subscription_type_' + rowId).val();


        //         // console.log("current ID", lastItemId, "row ID", rowId);
        //         // console.log("run_time_type_val", run_time_type_val, "row ID", rowId);


        //         // Only check rows that are before the current one

        //         if (rowId != lastItemId) {
        //             let farm_val = $('#farm_id_' + rowId).val();
        //             let sub_type_val = $('#subscription_type_' + rowId).val();
        //             let sub_name_val = parseInt($('#subscription_name_' + rowId).val());

        //             // console.log("current_sub_type_val", current_sub_type_val, "sub_type_val", sub_type_val);
        //             // console.log("rowId", rowId, "current_sub_type_val", "current_sub_type_val", rowId,
        //             // sub_type_val);

        //             if (farm_val == current_farm_val) {
        //                 // ✅ Check if Basic exists in any previous row
        //                 if (sub_name_val == 2) {
        //                     basicExists = true;
        //                 }
        //                 // ✅ Check if Gold or Silver exists in any previous row
        //                 if (sub_name_val == 4) {
        //                     goldExists = true;
        //                 }
        //                 if (sub_name_val == 3) {
        //                     SilverExists = true;
        //                 }
        //                 // ✅ Check if Premium exists in any previous row
        //                 if (sub_type_val === 'premium service') {
        //                     premiumExists = true;
        //                 }
        //             }
        //         }
        //     });

        //     // console.log("basicExists", basicExists, "goldOrSilverExists", goldOrSilverExists, "premiumExists",
        //     //     premiumExists);

        //     // ✅ Restriction: If Basic exists in a previous row, block Gold & Silver
        //     if (basicExists && (check_current_gold_type_val === 'gold' || current_sub_name_val === 3)) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Oops!',
        //             text: 'Basic package is already selected in a previous row for this farm. You cannot select Gold or Silver Package.',
        //             confirmButtonText: 'OK',
        //             confirmButtonColor: '#3085d6'
        //         }).then(() => remove_inputs_value(lastItemId));
        //         return;
        //     }

        //     // ✅ Restriction: If Gold exists in a previous row, block Basic & Premium
        //     if (goldExists && (current_sub_name_val === 2 || current_sub_name_val === 3 || current_sub_type_val ===
        //             'premium service')) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Oops!',
        //             text: 'Gold package is already selected in a previous row for this farm. You cannot select Silver or Basic or Premium Service.',
        //             confirmButtonText: 'OK',
        //             confirmButtonColor: '#3085d6'
        //         }).then(() => remove_inputs_value(lastItemId));
        //         return;
        //     }

        //     // ✅ Restriction: If Gold/Silver exists in a previous row, block Basic & Premium
        //     if (SilverExists && (current_sub_name_val === 2 || current_sub_name_val === 4 || current_sub_type_val ===
        //             'premium service')) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Oops!',
        //             text: 'Silver package is already selected in a previous row for this farm. You cannot select Gold or Basic or Premium Service.',
        //             confirmButtonText: 'OK',
        //             confirmButtonColor: '#3085d6'
        //         }).then(() => remove_inputs_value(lastItemId));
        //         return;
        //     }

        //     // ✅ Restriction: If Premium exists in a previous row, block Gold & Silver but allow Basic
        //     if (premiumExists && (current_sub_name_val === 4 || current_sub_name_val === 3)) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Oops!',
        //             text: 'Premium service is already selected in a previous row for this farm. You cannot select Gold or Silver Package.',
        //             confirmButtonText: 'OK',
        //             confirmButtonColor: '#3085d6'
        //         }).then(() => remove_inputs_value(lastItemId));
        //         return;
        //     }
        // }


        // for check existing subscription


        function sub_validation_row_data(lastItemId) {
            let current_farm_val = $('#farm_id_' + lastItemId).val();
            let current_sub_type_val = $('#subscription_type_' + lastItemId).val();
            let current_sub_name_val = parseInt($('#subscription_name_' + lastItemId).val()); // Convert to number if needed

            let current_sub_id = $('#subscription_name_' + lastItemId).val(); // ✅ Get ID from attribute
            let check_current_gold_type_val = '';
            let soil_check_current__type_val = '';


            // console.log(current_sub_id);

            // ✅ Check if the current row is "Gold" using ID
            if (current_sub_type_val === 'package' && current_sub_id == 4) {
                check_current_gold_type_val = 'gold';
            }
            if (current_sub_type_val === 'premium service' && current_sub_id == 4) {
                soil_check_current__type_val = 'soil';
            }
            // console.log("soil_check_current__type_val",soil_check_current__type_val);

            let basicExists = false;
            let goldExists = false;
            let silverExists = false;
            let premiumExists = false;
            let premiumSoilExists = false; // ✅ Separate check for "Premium Soil (4)"

            // ✅ Loop through only previous rows to check existing selections
            $('.farm-id-input').each(function() {
                let rowId = $(this).attr('id').split('_')[2];

                // Only check rows before the current one
                if (parseInt(rowId) != parseInt(lastItemId)) {
                    let farm_val = $('#farm_id_' + rowId).val();
                    let sub_type_val = $('#subscription_type_' + rowId).val();
                    let sub_name_val = parseInt($('#subscription_name_' + rowId).val());
                    let sub_id = $('#subscription_name_' + rowId).val(); // ✅ Get ID

                    if (farm_val == current_farm_val) {
                        // ✅ Check if Basic exists
                        if (sub_name_val == 2) {
                            basicExists = true;
                        }
                        // ✅ Check if Gold exists
                        if (sub_id == 4) {
                            goldExists = true;
                        }
                        // ✅ Check if Silver exists
                        if (sub_name_val == 3) {
                            silverExists = true;
                        }
                        // ✅ Check if Premium exists
                        if (sub_type_val === 'premium service') {
                            premiumExists = true;
                        }
                        // ✅ Check if Premium (Soil 4) exists
                        if (sub_id == 4) {
                            premiumSoilExists = true;
                        }
                    }
                }
            });

            // ✅ Restriction: If Basic exists in a previous row, block Gold & Silver
            if (basicExists && (check_current_gold_type_val === 'gold' || current_sub_name_val === 3)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Basic package is already selected in a previous row for this farm. You cannot select Gold or Silver Package.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => remove_inputs_value(lastItemId));
                return;
            }

            // ✅ Restriction: If Gold exists in a previous row, block Basic & Premium (not Silver)
            if (goldExists && (current_sub_name_val === 2 || current_sub_name_val === 3 || current_sub_type_val ===
                    7 || soil_check_current__type_val === 'soil')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Gold package is already selected in a previous row for this farm. You cannot select Basic or Premium Service.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => remove_inputs_value(lastItemId));
                return;
            }

            // ✅ Restriction: If Silver exists in a previous row, block Basic & Premium (not Gold)
            if (silverExists && (check_current_gold_type_val === 'gold' || current_sub_name_val === 2 ||
                    current_sub_type_val === 7 || soil_check_current__type_val === 'soil')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Silver package is already selected in a previous row for this farm. You cannot select Basic or Premium Service.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => remove_inputs_value(lastItemId));
                return;
            }

            // ✅ Restriction: If Premium exists in a previous row, block Gold & Silver but allow Basic
            if (premiumExists && (check_current_gold_type_val === 'gold' || current_sub_name_val === 3)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Premium service is already selected in a previous row for this farm. You cannot select Gold or Silver Package.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => remove_inputs_value(lastItemId));
                return;
            }

            // ✅ Restriction: If Premium Soil (4) exists in a previous row, allow only Basic
            if (premiumSoilExists && (current_sub_name_val === 3 || check_current_gold_type_val === 'gold')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    text: 'Premium Soil service is already selected in a previous row for this farm. You cannot select Gold or Silver Package.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => remove_inputs_value(lastItemId));
                return;
            }
        }


        function check_existing_subscription(lastItemId) {
            let current_farm_val = $('#farm_id_' + lastItemId).val();
            let sub_type_val = $('#subscription_type_' + lastItemId).val();
            let sub_name_val = $('#subscription_name_' + lastItemId).val();

            // console.log(current_farm_val);

            let isDuplicate = false; // Flag to check if duplicate is found

            $.ajax({
                url: "<?php echo e(url('existing-subscription')); ?>",
                method: "POST",
                data: {
                    farm_id: current_farm_val,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                success: function(res) {
                    let package_name = res.package_name.name;
                    let package_service_type = res.package_name.service_type;

                    // console.log(res_farm, res_type_val, res_name_val);
                    if (sub_type_val === 'package') {
                        if (package_name === 'Basic Package') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'Basic Package is already active in your farm.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                remove_inputs_value(lastItemId);
                            });

                            // Run the function immediately after triggering the alert
                            remove_inputs_value(lastItemId);
                        }
                        if (package_name === 'Silver Package') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'Silver Package is already active in your farm.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                remove_inputs_value(lastItemId);
                            });

                            // Run the function immediately after triggering the alert
                            remove_inputs_value(lastItemId);
                        }
                        if (package_name === 'Gold Package') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops!',
                                text: 'Gold Package is already active in your farm.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                remove_inputs_value(lastItemId);
                            });

                            // Run the function immediately after triggering the alert
                            remove_inputs_value(lastItemId);
                        }
                        if (package_service_type === 'premium') {
                            $.ajax({
                                url: "<?php echo e(url('premiumvalue')); ?>",
                                method: "POST",
                                data: {
                                    subscribable_id: sub_name_val,
                                    "_token": "<?php echo e(csrf_token()); ?>"
                                },
                                success: function(res) {
                                    if (res.pack_data.name !== 'Basic Package') {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Oops!',
                                            text: 'You not able to select the Package. Premium service is already active in your farm.',
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#3085d6'
                                        }).then(() => {
                                            remove_inputs_value(lastItemId);
                                        });
                                    }
                                }
                            });
                        }
                    } else {
                        $.ajax({
                            url: "<?php echo e(url('existing-subscription')); ?>",
                            method: "POST",
                            data: {
                                farm_id: current_farm_val,
                                "_token": "<?php echo e(csrf_token()); ?>"
                            },
                            success: function(res) {
                                let package_name = res.package_name.name;

                                if (package_name === 'Silver Package') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops!',
                                        text: 'Silver Package is already active in your farm.',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#3085d6'
                                    }).then(() => {
                                        remove_inputs_value(lastItemId);
                                    });

                                    // Run the function immediately after triggering the alert
                                    remove_inputs_value(lastItemId);
                                }
                                if (package_name === 'Gold Package') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops!',
                                        text: 'Gold Package is already active in your farm.',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#3085d6'
                                    }).then(() => {
                                        remove_inputs_value(lastItemId);
                                    });

                                    // Run the function immediately after triggering the alert
                                    remove_inputs_value(lastItemId);
                                }
                            },
                            error: function() {
                                // Swal.fire({
                                //     icon: 'error',
                                //     title: 'Oops!',
                                //     text: 'Something went wrong.',
                                //     confirmButtonText: 'OK',
                                //     confirmButtonColor: '#d33'
                                // });
                                remove_inputs_value(lastItemId);

                            }
                        });

                    }
                },
                error: function() {
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops!',
                    //     text: 'Something went wrong.',
                    //     confirmButtonText: 'OK',
                    //     confirmButtonColor: '#d33'
                    // });
                    remove_inputs_value(lastItemId);

                }
            });

        }

        function uppar_inputs_value_remove_() {
            $('#select_farmer').val('');
            $('#farmer_email').val('');
            $('#farmer_mobile').val('');
        }

        // for remove inputs value 

        function remove_inputs_value(lastItemId) {
            $('#farm_id_' + lastItemId).val('').trigger('change');
            $('#farm_area_' + lastItemId).val('');
            $('#subscription_type_' + lastItemId).val('');
            $('#subscription_name_' + lastItemId).val('');
            $('#duration_' + lastItemId).val('');
            $('#subscription_amount_' + lastItemId).val('');
            $('#subscription_payment_status_' + lastItemId).val('');
            $('#service_status_' + lastItemId).val('');
        }



        // for amount calculate
        function amount_calculation() {
            let total = 0;

            // Select all amount input fields dynamically added
            document.querySelectorAll('input[name="amount[]"]').forEach(input => {
                total += parseFloat(input.value) || 0; // Convert to number, default to 0 if empty
            });

            // Set the total amount in the total_amount input field
            document.getElementById('total_amount').value = total.toFixed(2); // Keep 2 decimal places
        }

        // Ensure one row is created on page load

        $(document).ready(function() {
            // $('#select_farmer').select2();
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

<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farmer_subscription\edit.blade.php ENDPATH**/ ?>