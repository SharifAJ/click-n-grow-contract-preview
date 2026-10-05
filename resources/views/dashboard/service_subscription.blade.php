<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Service Subscription')" />



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
                        Services
                    </a>

                    <a href="#" @click.prevent="openTab = 2"
                        :class="openTab === 2 ? activeClasses : inactiveClasses"
                        class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base">
                        Membership
                    </a>

                </div>
                <div>

                    <!-- ---------------------------------------------------------- -->

                    <div class="w-full">
                        <div class="bg-white" x-show="openTab === 1">
                            <table id="first_Table" class="table table-zebra">
                                <thead class="text-primary-content">
                                    <tr>
                                        <th>#</th>
                                        <th>Farmer Registrations</th>
                                        <th>Farm Additions</th>
                                        <th>Purchased Services</th>
                                        <th>Membership Subscription</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 100; @endphp
                                    @for ($i = 0; $i < $count; $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>John Doe {{ $i + 1 }}</td>
                                            <td>john{{ $i + 1 }}@example.com</td>
                                            <td>Admin</td>
                                            <td>NO</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-white" x-show="openTab === 2">
                            <table id="second_Table" class="table table-zebra">
                                <thead class="text-primary-content">
                                    <tr>
                                        <th>#</th>
                                        <th>Farmer Registrations</th>
                                        <th>Farm Additions</th>
                                        <th>Purchased Services</th>
                                        <th>Membership Subscription</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 100; @endphp
                                    @for ($i = 0; $i < $count; $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>John Doe {{ $i + 1 }}</td>
                                            <td>john{{ $i + 1 }}@example.com</td>
                                            <td>Admin</td>
                                            <td>NO</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
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
                                title: "KisanSat (Farmer Details)",

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4,
                                    ],
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'KisanSat (Farmer Details)',

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4,
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
            let dt = new DataTable("#second_Table", {
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
                                title: "KisanSat (Farmer Details)",

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4,
                                    ],
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'KisanSat (Farmer Details)',

                                exportOptions: {
                                    columns: [
                                        0, 1, 2, 3, 4,
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
