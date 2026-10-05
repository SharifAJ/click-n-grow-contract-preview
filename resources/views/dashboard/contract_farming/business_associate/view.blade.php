<x-app-layout>
    <x-header-title :title="__('Business Associate Enquiries')" />
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
                    <!-- <span class="py-4 text-sm font-medium border-b-2 text-primary md:text-base">
                        Business Associate Enquiries
                    </span> -->
                    
                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 1" :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Business Associate Enquiries
                    </a>

                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" :href="route('contract_farming.farmers.index')"
                        @click.prevent="openTab = 2" :class="openTab === 2 ? activeClasses : inactiveClasses">
                        Farmers Enquiries
                    </a>

                    <a class="py-4 text-sm font-medium border-b-2 hover:text-primary md:text-base" href="#"
                        @click.prevent="openTab = 3" :class="openTab === 3 ? activeClasses : inactiveClasses">
                        FNO Enquiries
                    </a>
                </div>

                <div class="w-full">
                    <div class="bg-white">
                        <table class="table" id="business_associates_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>State/District/Taluka</th>
                                    <th>Business Type</th>
                                    <th>Interested Crop(s)</th>
                                    <th>Expected Start</th>
                                    <th>Support Required</th>
                                    <th>Profile</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->company_name ?? 'N/A' }}</td>
                                        <td>{{ $record->contact_person ?? 'N/A' }}</td>
                                        <td>{{ $record->mobile ?? 'N/A' }}</td>
                                        <td>{{ $record->email ?? 'N/A' }}</td>
                                        <td>{{ $record->state_district_taluka ?? 'N/A' }}</td>
                                        <td>{{ $record->business_type ?? 'N/A' }}</td>
                                        <td>{{ $record->interested_crop ?? 'N/A' }}</td>
                                        <td>{{ $record->expected_start_time ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->support_required)
                                                {{ is_array($record->support_required) ? implode(', ', $record->support_required) : $record->support_required }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->upload_profile)
                                                <a href="{{ asset('storage/'.$record->upload_profile) }}" target="_blank" class="text-blue-500">View</a>
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

        {{-- Success/Error Alerts --}}
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

        {{-- DataTable --}}
        <script>
            $(document).ready(function() {
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
            });
        </script>
</x-app-layout>
