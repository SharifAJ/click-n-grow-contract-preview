<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('APIs Log')" />

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
					{{-- <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
						@click.prevent="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses">
						API Usage
					</a> --}}
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

								@if ($summary_data->isEmpty())
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
								@else
									@foreach ($summary_data as $data)
										<tr>
											<td>{{ $loop->iteration ?? 'N/A' }}</td>
											<td>{{ $data->users_name ?? 'N/A' }}</td>
											<td>{{ $data->farm_id ?? 'N/A' }}</td>
											<td>{{ $data->service_name ?? 'N/A' }}</td>
											@if ($data->is_successful == 1)
												<td>Successful</td>
											@else
												<td>Failed</td>
											@endif
											<td>{{ $data->error_message ?? 'N/A' }}</td>
											<td>{{ date('d-M-Y', strtotime($data->request_logs_created_at)) }}</td>
											<td>{{ isset($data->execution_time) ? number_format($data->execution_time, 0) . 's' : 'N/A' }}</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>

                    {{-- API Usage table --}}
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
                                @if ($usage->isEmpty())
                                    <tr>
                                        <td class="text-center">No records found</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($usage as $record)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($record->date)) }}</td>
                                            <td>{{ $record->endpoint }}</td>
                                            <td>{{ $record->total }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Daily API usage count --}}
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
                                @if ($dailyUsage->isEmpty())
                                    <tr>
                                        <td class="text-center">No records found</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($dailyUsage as $usage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($usage->date)) }}</td>
                                            <td>{{ $usage->count }}</td>
                                        </tr>
                                    @endforeach

                                @endif
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

</x-app-layout>
