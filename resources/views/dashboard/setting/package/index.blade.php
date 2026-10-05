<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="'Package Master'" />

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
                        Package Master
                    </a>

                </div>
                <div>
                    <div x-show="openTab === 1" class="  leading-relaxed">
                        <div class="text-end">
                            <a href="{{ route('packagemaster.create') }}" class="btn btn-success text-white">
                                Add New Package
                            </a>
                        </div>
                        <table class="table" id="first_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Package Name</th>
                                    <th>Description</th>
                                    <th>Total Services</th>
                                    <th>Subscription Duration</th>
                                    <th>Amount/Acre (Rs)</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pack_master_data as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>{{ $data->services_count }} Services</td>
                                        <td>{{ $data->duration }} months</td>
                                        <td>{{ $data->amount ?? 'N/A' }}</td>
                                        <td>{{ date('d-M-Y', strtotime($data->created_at ?? 'N/A')) }}</td>
                                        <td> <input type="checkbox" {{ $data->status === 'active' ? 'checked' : '' }}
                                                onclick="package_master_active_button({{ $data->id }}, {{ $loop->iteration }})"
                                                id="active_inactive_{{ $loop->iteration }}">
                                        </td>
                                        <td>
                                            <a class="  items-center gap-2 text-info"
                                                href="{{ route('packagemaster.show', $data->id) }}">
                                                <i class="fas fa-eye text-2xl px-2"></i>
                                            </a>

                                        </td>
                                        {{-- <td class="relative">
                                            <div class="dropdown dropdown-end">
                                                <button tabindex="0" class="btn btn-sm btn-ghost">
                                                    <i class="fas fa-ellipsis-v text-lg"></i>
                                                </button>
                                                <ul tabindex="0"
                                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-36">
                                                    <li>
                                                        <a href="{{ route('packagemaster.show', $data->id) }}"
                                                            class="flex items-center gap-2 text-info">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            function package_master_active_button(id, count) {

                let input = document.getElementById(`active_inactive_${count}`);

                let active_value; // Initialize variable without assigning an invalid value
                if (input.checked === true) {
                    active_value = "active";
                } else {
                    active_value = "inactive";
                }
                // console.log(active_value);

                $.ajax({
                    url: "{{ url('change-package_master-status') }}",
                    method: "POST",
                    data: {
                        pack_master_id: id,
                        status: active_value,
                        "_token": "{{ csrf_token() }}",
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
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        timer: 7000, // Auto close after 3 seconds
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
                // Initialize DataTables
                let dt = new DataTable("#first_Table", {
                    fixedColumns: {
                        left: 1,
                        right: 1,
                    },
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
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
                                    title: "KisanSat (Service Master Details)",

                                    exportOptions: {
                                        columns: [
                                            0, 1, 2, 3, 4, 6,
                                        ],
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Service Master Details)',

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

</x-app-layout>
