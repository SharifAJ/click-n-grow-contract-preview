<x-app-layout>
    <x-header-title :title="__('Enquiry Details')" />

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
                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                       @click.prevent="openTab = 1" 
                       :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Business Associate Enquiries
                    </a>

                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                       @click.prevent="openTab = 2" 
                       :class="openTab === 2 ? activeClasses : inactiveClasses">
                        Farmers Enquiries
                    </a>

                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                       @click.prevent="openTab = 3" 
                       :class="openTab === 3 ? activeClasses : inactiveClasses">
                        FPO Enquiries
                    </a>
                </div>

                <div class="w-full">
                    {{-- Business Associate Enquiries Tab --}}
                    <div class="bg-white" x-show="openTab === 1">
                        <table class="table" id="business_associates_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Company Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>State/District</th>
                                    <th>Experience</th>
                                    <th>Operating Area</th>
                                    <th>Network Type</th>
                                    <th>Reason</th>
                                    <th>Resume</th>
                                    <th>Preferred Contact</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($business_associate_enquires ?? [] as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->full_name ?? 'N/A' }}</td>
                                        <td>{{ $record->company_name ?? 'N/A' }}</td>
                                        <td>{{ $record->mobile ?? 'N/A' }}</td>
                                        <td>{{ $record->email ?? 'N/A' }}</td>
                                        <td>{{ $record->state_district ?? 'N/A' }}</td>
                                        <td>{{ $record->experience ?? 'N/A' }} years</td>
                                        <td>{{ $record->operating_area ?? 'N/A' }}</td>
                                        <td>{{ $record->network_type ?? 'N/A' }}</td>
                                        <td>{{ $record->reason ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->resume)
                                                <a href="{{ asset('storage/'.$record->resume) }}" target="_blank" class="text-blue-500">View</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $record->preferred_contact ?? 'N/A' }}</td>
                                        <td>{{ $record->created_at ? $record->created_at->format('d-M-Y') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Farmers Enquiries Tab --}}
                    <div class="bg-white" x-show="openTab === 2">
                        <table class="table" id="farmer_enquiries_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>State/District</th>
                                    <th>Village</th>
                                    <th>Land Area</th>
                                    <th>Irrigation</th>
                                    <th>Land Type</th>
                                    <th>Previous Crops</th>
                                    <th>Interested Crops</th>
                                    <th>Start Month</th>
                                    <th>Support Required</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($farmers ?? [] as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->full_name ?? 'N/A' }}</td>
                                        <td>{{ $record->mobile ?? 'N/A' }}</td>
                                        <td>{{ $record->email ?? 'N/A' }}</td>
                                        <td>{{ $record->state_district ?? 'N/A' }}</td>
                                        <td>{{ $record->village ?? 'N/A' }}</td>
                                        <td>{{ $record->land_area ?? 'N/A' }} Acres</td>
                                        <td>{{ $record->irrigation ?? 'N/A' }}</td>
                                        <td>{{ $record->land_type ?? 'N/A' }}</td>
                                        <td>{{ $record->previous_crops ?? 'N/A' }}</td>
                                        <td>{{ $record->interested_crops ?? 'N/A' }}</td>
                                        <td>{{ $record->start_month ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->preferred_support)
                                                {{ is_array($record->preferred_support) ? implode(', ', $record->preferred_support) : $record->preferred_support }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $record->additional_comments ?? 'N/A' }}</td>
                                        <td>{{ $record->created_at ? $record->created_at->format('d-M-Y') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- FPO Enquiries Tab --}}
                    <div class="bg-white" x-show="openTab === 3">
                        <table class="table" id="fpo_enquiries_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Group Name</th>
                                    <th>Registration Number</th>
                                    <th>Contact Person</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>State/District/Taluka</th>
                                    <th>Number of Farmers</th>
                                    <th>Total Land</th>
                                    <th>Current Crops</th>
                                    <th>Interested Crops</th>
                                    <th>Expected Start</th>
                                    <th>Support Required</th>
                                    <th>Profile</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fpos ?? [] as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->group_name ?? 'N/A' }}</td>
                                        <td>{{ $record->registration_number ?? 'N/A' }}</td>
                                        <td>{{ $record->contact_person ?? 'N/A' }}</td>
                                        <td>{{ $record->mobile ?? 'N/A' }}</td>
                                        <td>{{ $record->email ?? 'N/A' }}</td>
                                        <td>{{ $record->state_district_taluka ?? 'N/A' }}</td>
                                        <td>{{ $record->number_of_farmers ?? 'N/A' }}</td>
                                        <td>{{ $record->total_land ?? 'N/A' }} Acres</td>
                                        <td>{{ $record->current_crops ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->interested_crops)
                                                {{ is_array($record->interested_crops) ? implode(', ', $record->interested_crops) : $record->interested_crops }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $record->expected_start ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->support)
                                                {{ is_array($record->support) ? implode(', ', $record->support) : $record->support }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->group_profile)
                                                <a href="{{ asset('storage/'.$record->group_profile) }}" target="_blank" class="text-blue-500">View</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $record->remarks ?? 'N/A' }}</td>
                                        <td>{{ $record->created_at ? $record->created_at->format('d-M-Y') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        timer: 7000,
                        showConfirmButton: false
                    });
                @endif

                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: "{{ session('error') }}",
                        timer: 7000,
                        showConfirmButton: false
                    });
                @endif
            });
        </script>

        <script>
            $(document).ready(function() {
                // Business Associate Enquiries DataTable
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

                // Farmer Enquiries DataTable
                new DataTable("#farmer_enquiries_Table", {
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
                                    title: "KisanSat (Farmer Enquiries)",
                                    exportOptions: { columns: ':visible' }
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Farmer Enquiries)',
                                    exportOptions: { columns: ':visible' },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    }
                                }
                            ],
                        },
                    },
                });

                // FPO Enquiries DataTable
                new DataTable("#fpo_enquiries_Table", {
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
                                    title: "KisanSat (FPO Enquiries)",
                                    exportOptions: { columns: ':visible' }
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (FPO Enquiries)',
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
</x-app-layout>
