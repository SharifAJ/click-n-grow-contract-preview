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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Farmer Subscription  Show'))]); ?>
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
        <div class="rounded-lg border border-gray-200 bg-white shadow-md    p-5">
            
            <div class="flex justify-between items-center pb-4 border-b">
                <h4 class="text-lg font-bold text-black-700 dark:text-black-300 pb-4 border-b">Farmer Subscription
                    Details</h4>
                <a href="<?php echo e(route('subscription.index')); ?>" class="btn btn-neutral">
                    Back
                </a>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                    <tbody class="text-black-800 dark:text-black-300">
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Farmer ID</th>
                            <td class="p-3"><?php echo e($subscription_data->farms->user->farmer_id); ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Name</th>
                            <td class="p-3"><?php echo e($subscription_data->farms->user->name); ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Email</th>
                            <td class="p-3"><?php echo e($subscription_data->farms->user->email); ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Mobile No.</th>
                            <td class="p-3"><?php echo e($subscription_data->farms->user->mobile ?? 'N/A'); ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Registration Date</th>
                            <td class="p-3">
                                <?php echo e(date('d-M-Y', strtotime($subscription_data->subscription_date ?? 'N/A'))); ?>

                            </td>
                        </tr>

                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Remark</th>
                            <td class="p-3"><?php echo e(ucfirst($subscription_data->remark) ?? 'N/A'); ?></td>
                        </tr>
                        



                    </tbody>
                </table>
            </div>

            
            <div class="mt-9 mb-9">
                <h4 class="text-lg font-bold text-black-700 dark:text-black-300 pb-4 border-b">Farm Subscriptions
                    Details</h4>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                        <thead class="bg-black-100  text-black-700 dark:text-black-300">
                            <tr>
                                <th class="p-3">Farm ID</th>
                                <th class="p-3">Farm Name</th>
                                <th class="p-3">Farm Area</th>
                                <th class="p-3">Subscription Code</th>
                                <th class="p-3">Subscription Type</th>
                                <th class="p-3">Subscription Name</th>
                                <th class="p-3">Subscription Duration</th>
                                <th class="p-3">Amount</th>
                                <th class="p-3">Start Date</th>
                                <th class="p-3">End Date</th>
                                <th class="p-3">Payment Status</th>
                                <th class="p-3">Subscription Status</th>
                                
                            </tr>
                        </thead>
                        <tbody class="text-black-800 dark:text-black-300">
                            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo e($subscription->farms->farm_id); ?> </td>
                                    <td class="p-3">
                                        <?php echo e($subscription->farms->name); ?></td>
                                    <td class="p-3"><?php echo e(floor($subscription->farms->area * 10) / 10); ?> acres</td>
                                    <td class="p-3"><?php echo e($subscription->subscription_code); ?></td>
                                    <?php if($subscription->subscribable_type === 'App\Models\PackageMasterModel'): ?>
                                        <td class="p-3">Package</td>
                                    <?php else: ?>
                                        <td class="p-3">Premium Service</td>
                                    <?php endif; ?>
                                    <td class="p-3"><?php echo e($subscription->subscribable_name); ?></td>
                                    <td class="p-3"><?php echo e($subscription->sub_duration); ?></td>
                                    <td class="p-3"><?php echo e($subscription->amount); ?></td>
                                    <td class="p-3"><?php echo e(date('d-M-Y', strtotime($subscription->starts_at))); ?></td>
                                    <td class="p-3"><?php echo e(date('d-M-Y', strtotime($subscription->expires_at))); ?></td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 rounded  font-bold
                                        <?php if($subscription->payment_status == 'completed'): ?> text-green-500 
                                        <?php elseif($subscription->payment_status == 'pending'): ?> text-yellow-500
                                        <?php elseif($subscription->payment_status == 'failed'): ?> text-red-500
                                        <?php elseif($subscription->payment_status == 'cancelled'): ?> text-gray-500
                                        <?php elseif($subscription->payment_status == 'refunded'): ?> text-blue-500
                                        <?php elseif($subscription->payment_status == 'disputed'): ?> text-purple-500
                                        <?php elseif($subscription->payment_status == 'not applicable'): ?> text-yellow-500
                                        <?php else: ?> text-gray-400 <?php endif; ?>">
                                            <?php echo e(ucfirst($subscription->payment_status)); ?>

                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 rounded   font-bold
                                            <?php echo e($subscription->status == 'active' ? 'text-green-500' : 'text-red-500'); ?>">
                                            <?php echo e(ucfirst($subscription->status)); ?>

                                        </span>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>


            
            <div class="mt-9 mb-9">
                <h4 class="text-lg font-bold text-black-700 dark:text-black-300 pb-4 border-b">Transaction
                    Details</h4>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                        <thead class="bg-black-100  text-black-700 dark:text-black-300">
                            <tr>
                                <th class="p-3">Transaction ID</th>
                                <th class="p-3">Gateway Name</th>
                                
                                <th class="p-3">Gateway Response</th>
                                <th class="p-3">Amount</th>
                                <th class="p-3">Payment Method</th>
                                <th class="p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-black-800 dark:text-black-300">
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo e($payment->transaction_id ?? 'N/A'); ?></td>
                                    <td class="p-3"><?php echo e($payment->gateway_name ?? 'N/A'); ?></td>
                                    
                                    <td class="p-3"><?php echo e($payment->gateway_response['status'] ?? 'N/A'); ?></td>
                                    <td class="p-3"><?php echo e($payment->amount ?? 'N/A'); ?></td>
                                    <td class="p-3"><?php echo e($payment->payment_method ?? 'N/A'); ?></td>
                                    <td class="p-3"><?php echo e(ucfirst($payment->status) ?? 'N/A'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\farmer_subscription\mobile_view.blade.php ENDPATH**/ ?>