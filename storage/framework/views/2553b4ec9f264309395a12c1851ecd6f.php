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
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('APIs Log'))]); ?>
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
						API Log
					</a>
					
					<a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
						@click.prevent="openTab = 3" :class="openTab === 3 ? activeClasses : inactiveClasses">
						Total API Hits/Day
					</a>
				</div>
				<div>
					<div class="leading-relaxed" x-show="openTab === 1">
						<table class="table" id="first_Table">
							<thead class="text-primary-content">
								<tr>
									<th>#</th>
									<th>User Name</th>
									<th>Farm Id</th>
									<th>Service Request</th>
									<th>Successful</th>
									<th>Error Message </th>
									<th>Created Date</th>
									<th class="tooltip" data-tip="How long the external API took to respond (in seconds)">Latency</th>
								</tr>
							</thead>
							<tbody>

								<?php if($summary_data->isEmpty()): ?>
									<tr>
										<td class="text-center">No records found</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								<?php else: ?>
									<?php $__currentLoopData = $summary_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration ?? 'N/A'); ?></td>
											<td><?php echo e($data->users_name ?? 'N/A'); ?></td>
											<td><?php echo e($data->farm_id ?? 'N/A'); ?></td>
											<td><?php echo e($data->service_name ?? 'N/A'); ?></td>
											<?php if($data->is_successful == 1): ?>
												<td>Successful</td>
											<?php else: ?>
												<td>Failed</td>
											<?php endif; ?>
											<td><?php echo e($data->error_message ?? 'N/A'); ?></td>
											<td><?php echo e(date('d-M-Y', strtotime($data->request_logs_created_at))); ?></td>
											<td><?php echo e(isset($data->execution_time) ? number_format($data->execution_time, 0) . 's' : 'N/A'); ?></td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>

                    
                    <div class="leading-relaxed" x-show="openTab === 2">
                        <table class="table" id="api_usage_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Endpoint</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($usage->isEmpty()): ?>
                                    <tr>
                                        <td class="text-center">No records found</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php else: ?>
                                    <?php $__currentLoopData = $usage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($record->date))); ?></td>
                                            <td><?php echo e($record->endpoint); ?></td>
                                            <td><?php echo e($record->total); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="leading-relaxed" x-show="openTab === 3">
                        <table class="table" id="daily_usage_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Total API Hits</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($dailyUsage->isEmpty()): ?>
                                    <tr>
                                        <td class="text-center">No records found</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php else: ?>
                                    <?php $__currentLoopData = $dailyUsage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($usage->date))); ?></td>
                                            <td><?php echo e($usage->count); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                title: "KisanSat (APIs Log Details)",

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4, 5, 6
                                    ],
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'KisanSat (APIs Log Details)',

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4, 5, 6
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
        $(document).ready(function() {
            // Initialize DataTables
            let dt = new DataTable("#api_usage_table", {
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
                                title: "KisanSat (API Usage Details)",

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3
                                    ],
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'KisanSat (API Usage Details)',

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3
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
        $(document).ready(function() {
            // Initialize DataTables
            let dt = new DataTable("#daily_usage_table", {
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
                                title: "KisanSat (Total API Hits Details)",

                                exportOptions: {
                                    columns: [
                                        0, 1, 2
                                    ],
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'KisanSat (Total API Hits Details)',

                                exportOptions: {
                                    columns: [
                                        0, 1, 2
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
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views\dashboard\all_log.blade.php ENDPATH**/ ?>