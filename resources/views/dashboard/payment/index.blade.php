<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Payment Transaction')" />





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
                        Payments
                    </a>
                </div>
                <div>

                    <div class="w-full">
                        <div class="bg-white" x-show="openTab === 1">
                            {{-- <div class="text-end">
                                <!-- Button to open modal -->
                                <button onclick="openModal()" class="btn btn-success text-white">
                                    New Payment
                                </button>
                            </div> --}}

                            <!-- Modal -->
                            {{-- <dialog id="paymentModal" class="modal">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">
                                        Select Farmer <span class="text-red-500">*</span>
                                    </h3>
                                    <form id="paymentForm" action="{{ route('paymentcreate') }}" method="POST">
                                        @csrf
                                        <label class="block text-sm font-medium text-gray-700 mt-2">
                                            Farmer <span class="text-red-500">*</span>
                                        </label>
                                        <select name="user_id" id="farmerSelect"
                                            class="select select-bordered w-full mt-2" required>
                                            <option value="" disabled selected>Select Farmer</option>
                                            @foreach ($farmers as $farmer)
                                                <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="modal-action">
                                            <button type="submit" class="btn btn-primary">Proceed</button>
                                            <button type="button" onclick="closeModal()" class="btn">Cancel</button>
                                        </div>
                                    </form>

                                </div>
                            </dialog> --}}

                            <table id="first_Table" class="table table-zebra">
                                <thead class="text-primary-content">
                                    <tr>
                                        <th>#</th>
                                        <th>Bill id</th>
                                        <th>Farmer</th>
                                        <th>Farm name</th>
                                        <th>Service Subscription </th>
                                        <th>Amount</th>
                                        {{-- <th>Discount</th> --}}
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $payments = [
                                            [
                                                'bill_id' => 'BILL001',
                                                'farmer' => 'John Doe',
                                                'farm_name' => 'Green Farm',
                                                'service' => 'Irrigation',
                                                'amount' => 500,
                                                'payment_type' => 'UPI',
                                                'payment_status' => 'Completed',
                                                'remark' => 'Paid on time',
                                            ],
                                            [
                                                'bill_id' => 'BILL002',
                                                'farmer' => 'Alice Smith',
                                                'farm_name' => 'Sunshine Farm',
                                                'service' => 'Fertilization',
                                                'amount' => 300,
                                                'payment_type' => 'Cash',
                                                'payment_status' => 'Pending',
                                                'remark' => 'Waiting for confirmation',
                                            ],
                                            [
                                                'bill_id' => 'BILL003',
                                                'farmer' => 'Raj Kumar',
                                                'farm_name' => 'Organic Fields',
                                                'service' => 'Pest Control',
                                                'amount' => 450,
                                                'payment_type' => 'Bank Transfer',
                                                'payment_status' => 'Completed',
                                                'remark' => 'Confirmed',
                                            ],
                                            [
                                                'bill_id' => 'BILL004',
                                                'farmer' => 'Mohan Das',
                                                'farm_name' => 'Harvest Hub',
                                                'service' => 'Soil Testing',
                                                'amount' => 250,
                                                'payment_type' => 'Credit Card',
                                                'payment_status' => 'Failed',
                                                'remark' => 'Retry needed',
                                            ],
                                            [
                                                'bill_id' => 'BILL005',
                                                'farmer' => 'Sneha Patil',
                                                'farm_name' => 'Fresh Farm',
                                                'service' => 'Drip Irrigation',
                                                'amount' => 600,
                                                'payment_type' => 'UPI',
                                                'payment_status' => 'Completed',
                                                'remark' => 'Smooth transaction',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $payment['bill_id'] }}</td>
                                            <td>{{ $payment['farmer'] }}</td>
                                            <td>{{ $payment['farm_name'] }}</td>
                                            <td>{{ $payment['service'] }}</td>
                                            <td>₹{{ number_format($payment['amount'], 2) }}</td>
                                            <td>{{ $payment['payment_type'] }}</td>
                                            <td
                                                class="{{ $payment['payment_status'] == 'Completed' ? 'text-green-500' : ($payment['payment_status'] == 'Pending' ? 'text-yellow-500' : 'text-red-500') }}">
                                                {{ $payment['payment_status'] }}
                                            </td>
                                            <td>{{ $payment['remark'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            $('#farmerSelect').select2({
                dropdownParent: $("#paymentModal") // Ensure dropdown works inside modal
            });
        });

        function openModal() {
            document.getElementById("paymentModal").showModal();
            setTimeout(() => {
                $('#farmerSelect').select2({
                    dropdownParent: $("#paymentModal") // Reinitialize Select2 inside modal
                });
            }, 100);
        }

        function closeModal() {
            document.getElementById("paymentModal").close();
        }
    </script>
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
    </script>
</x-app-layout>
