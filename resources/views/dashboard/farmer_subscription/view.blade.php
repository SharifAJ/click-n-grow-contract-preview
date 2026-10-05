<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farmer Subscription  Show')" />

    <div class="  mt-5">
        <div class="rounded-lg border border-gray-200 bg-white shadow-md    p-5">
            {{-- Farmer Details --}}
            <div class="flex justify-between items-center pb-4 border-b">
                <h4 class="text-lg font-bold text-black-700 dark:text-black-300 pb-4 border-b">Farmer Subscription
                    Details</h4>
                <a href="{{ route('subscription.index') }}"
                    class="btn btn-neutral">
                    Back
                </a>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                    <tbody class="text-black-800 dark:text-black-300">
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Farmer ID</th>
                            <td class="p-3">{{ $subscription_data->farms->user->farmer_id }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Name</th>
                            <td class="p-3">{{ $subscription_data->farms->user->name }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Email</th>
                            <td class="p-3">{{ $subscription_data->farms->user->email }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Mobile No.</th>
                            <td class="p-3">{{ $subscription_data->farms->user->mobile ?? 'N/A' }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Registration Date</th>
                            <td class="p-3">
                                {{ date('d-M-Y', strtotime($subscription_data->subscription_date ?? 'N/A')) }}
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100 ">Remark</th>
                            <td class="p-3">{{ ucfirst($subscription_data->remark) ?? 'N/A' }}</td>
                        </tr>
                        {{-- 
                        <tr class="border-b">
                            <th class="p-3 text-left bg-black-100">Total Amount</th>
                            <td class="p-3">{{ number_format($payment_total_amt, 2) }}</td>

                        </tr> --}}



                    </tbody>
                </table>
            </div>

            {{-- Subscription Details --}}
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
                                {{-- <th class="p-3">Remark</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-black-800 dark:text-black-300">
                            @foreach ($subscriptions as $subscription)
                                <tr class="border-t">
                                    <td class="p-3">{{ $subscription->farms->farm_id }} </td>
                                    <td class="p-3">
                                        {{ $subscription->farms->name }}</td>
                                    <td class="p-3">{{ floor($subscription->farms->area * 10) / 10}} acres</td>
                                    <td class="p-3">{{ $subscription->subscription_code }}</td>
                                    @if ($subscription->subscribable_type === 'App\Models\PackageMasterModel')
                                        <td class="p-3">Package</td>
                                    @else
                                        <td class="p-3">Premium Service</td>
                                    @endif
                                    <td class="p-3">{{ $subscription->subscribable_name }}</td>
                                    <td class="p-3">{{ $subscription->sub_duration }}</td>
                                    <td class="p-3">{{ $subscription->amount }}</td>
                                    <td class="p-3">{{ date('d-M-Y', strtotime($subscription->starts_at)) }}</td>
                                    <td class="p-3">{{ date('d-M-Y', strtotime($subscription->expires_at)) }}</td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 rounded  font-bold
                                        @if ($subscription->payment_status == 'completed') text-green-500 
                                        @elseif($subscription->payment_status == 'pending') text-yellow-500
                                        @elseif($subscription->payment_status == 'failed') text-red-500
                                        @elseif($subscription->payment_status == 'cancelled') text-gray-500
                                        @elseif($subscription->payment_status == 'refunded') text-blue-500
                                        @elseif($subscription->payment_status == 'disputed') text-purple-500
                                        @elseif($subscription->payment_status == 'not applicable') text-yellow-500
                                        @else text-gray-400 @endif">
                                            {{ ucfirst($subscription->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 rounded   font-bold
                                            {{ $subscription->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                                            {{ ucfirst($subscription->status) }}
                                        </span>
                                    </td>
                                    {{-- <td class="p-3">{{ $subscription->remark ?? 'N/A' }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Transaction  Details --}}
            {{-- <div class="mt-9 mb-9">
                <h4 class="text-lg font-bold text-black-700 dark:text-black-300 pb-4 border-b">Transaction
                    Details</h4>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                        <thead class="bg-black-100  text-black-700 dark:text-black-300">
                            <tr>
                                <th class="p-3">Transaction ID</th>
                                <th class="p-3">Amount</th>
                                <th class="p-3">Payment Method</th>
                                <th class="p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-black-800 dark:text-black-300">
                            @foreach ($payments as $payment)
                                <tr class="border-t">
                                    <td class="p-3">{{ $payment->transaction_id ?? 'N/A' }}</td>
                                    <td class="p-3">{{ $payment->amount ?? 'N/A' }}</td>
                                    <td class="p-3">{{ $payment->payment_method ?? 'N/A' }}</td>
                                    <td class="p-3">{{ ucfirst($payment->status) ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}

        </div>
    </div>
</x-app-layout>
