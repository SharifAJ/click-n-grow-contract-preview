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
        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">
            <div class="mb-14 w-full p-7" 
                x-data="{
                    openTab: 1,
                    activeClasses: 'text-primary border-primary',
                    inactiveClasses: 'border-transparent',
                }"
            >
                <div class="border-stroke dark:border-strokedark mb-6 flex flex-wrap gap-5 border-b sm:gap-10">
                    <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base" href="#"
                       @click.prevent="openTab = 1" 
                       :class="openTab === 1 ? activeClasses : inactiveClasses">
                        Enquiry Details
                    </a>
                </div>

                <div class="w-full">
                    <div class="bg-white" x-show="openTab === 1">
                        <table class="table" id="enquiries_Table">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Address</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquiries as $enquiry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $enquiry->name ?? 'N/A' }}</td>
                                        <td>{{ $enquiry->email ?? 'N/A' }}</td>
                                        <td>{{ $enquiry->mobile ?? 'N/A' }}</td>
                                        <td>{{ $enquiry->address ?? 'N/A' }}</td>
                                        <td>{{ $enquiry->message ?? 'N/A' }}</td>
                                        <td>{{ date('d-M-Y', strtotime($enquiry->created_at)) ?? 'N/A' }}</td>
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
                let dt = new DataTable("#enquiries_Table", {
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
                            buttons: [
                                { extend: "pageLength" },
                                {
                                    extend: "excel",
                                    text: "Excel",
                                    title: "KisanSat (Enquiry Details)",
                                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: 'KisanSat (Enquiry Details)',
                                    exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
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
