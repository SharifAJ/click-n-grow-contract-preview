<x-app-layout>
    <x-header-title :title="__('Expert Visit Registration Details')" />

    <div class="mt-5 space-y-6">
        {{-- Top action bar --}}
        <div class="flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('admin.expert-visits.index') }}" class="btn btn-sm btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Back to Registrations
            </a>

            <div class="flex items-center gap-3">
                <form method="POST"
                      action="{{ route('admin.expert-visits.destroy', $registration->id) }}"
                      onsubmit="return confirm('Are you sure you want to permanently delete this registration?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline btn-error">
                        <i class="fa-solid fa-trash"></i> Delete Registration
                    </button>
                </form>
            </div>
        </div>

        {{-- Overview Cards --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <div class="rounded-sm border border-stroke bg-white p-5 shadow-default">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Payment Status</span>
                <div class="mt-2 flex items-center gap-2">
                    @if ($registration->payment_status === 'paid')
                        <span class="badge badge-success text-sm text-white">Paid</span>
                    @elseif ($registration->payment_status === 'order_failed')
                        <span class="badge badge-error text-sm text-white">Order Failed</span>
                    @else
                        <span class="badge badge-warning text-sm text-white">Pending</span>
                    @endif
                </div>
                <span class="mt-1 block text-xs text-gray-400">Reference: {{ Str::limit($registration->reference, 18) }}</span>
            </div>

            <div class="rounded-sm border border-stroke bg-white p-5 shadow-default">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Fee</span>
                <p class="mt-2 text-2xl font-bold text-gray-900">₹{{ number_format($registration->total_fee) }}</p>
                <span class="text-xs text-gray-500">Rate: ₹{{ number_format($registration->fee_per_day) }}/day ({{ $registration->visit_days }} {{ Str::plural('day', $registration->visit_days) }})</span>
            </div>

            <div class="rounded-sm border border-stroke bg-white p-5 shadow-default">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Preferred Visit Date</span>
                <p class="mt-2 text-lg font-bold text-gray-900">{{ $registration->preferred_visit_date?->format('d M Y') ?? '—' }}</p>
                <span class="text-xs text-gray-500">Nearest Station: {{ $registration->nearest_railway_station }}</span>
            </div>

            <div class="rounded-sm border border-stroke bg-white p-5 shadow-default">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Registered Farms</span>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $registration->farms->count() }}</p>
                <span class="text-xs text-gray-500">Total Land: {{ number_format($registration->farms->sum('area_acres'), 2) }} acres</span>
            </div>
        </div>

        {{-- Details Grid --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            {{-- Applicant Details --}}
            <div class="rounded-sm border border-stroke bg-white p-6 shadow-default">
                <h4 class="mb-4 text-base font-semibold text-gray-800 border-b border-gray-100 pb-2">
                    <i class="fa-solid fa-user me-2 text-emerald-600"></i> Personal & Contact Information
                </h4>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">Applicant Full Name:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->name }} {{ $registration->surname }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">Father's Name:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->father_name }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">Mobile Number:</dt>
                        <dd class="font-medium">
                            <a href="tel:{{ $registration->mobile }}" class="text-emerald-700 hover:underline">
                                {{ $registration->mobile }}
                            </a>
                        </dd>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">Terms Accepted:</dt>
                        <dd class="text-gray-700">{{ $registration->terms_accepted_at?->format('d M Y, h:i A') ?? 'Yes' }}</dd>
                    </div>
                    <div class="flex justify-between py-1">
                        <dt class="text-gray-500">Submission Date:</dt>
                        <dd class="text-gray-700">{{ $registration->created_at?->format('d M Y, h:i A') ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Residential Address --}}
            <div class="rounded-sm border border-stroke bg-white p-6 shadow-default">
                <h4 class="mb-4 text-base font-semibold text-gray-800 border-b border-gray-100 pb-2">
                    <i class="fa-solid fa-house me-2 text-emerald-600"></i> Residential Address
                </h4>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">Village:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->residential_village }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">Taluka:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->residential_taluka }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">District:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->residential_district }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 py-1">
                        <dt class="text-gray-500">State:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->residential_state }}</dd>
                    </div>
                    <div class="flex justify-between py-1">
                        <dt class="text-gray-500">Pincode:</dt>
                        <dd class="font-medium text-gray-900">{{ $registration->residential_pincode }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Payment & Transaction Details --}}
        <div class="rounded-sm border border-stroke bg-white p-6 shadow-default">
            <h4 class="mb-4 text-base font-semibold text-gray-800 border-b border-gray-100 pb-2">
                <i class="fa-solid fa-credit-card me-2 text-emerald-600"></i> Payment & Razorpay Identifiers
            </h4>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3 text-sm">
                <div class="rounded border border-gray-100 bg-gray-50 p-3">
                    <span class="block text-xs text-gray-500">Registration UUID Reference</span>
                    <span class="block font-mono text-xs font-semibold text-gray-800 break-all select-all">{{ $registration->reference }}</span>
                </div>
                <div class="rounded border border-gray-100 bg-gray-50 p-3">
                    <span class="block text-xs text-gray-500">Razorpay Order ID</span>
                    <span class="block font-mono text-xs font-semibold text-gray-800 break-all select-all">{{ $registration->razorpay_order_id ?? 'None' }}</span>
                </div>
                <div class="rounded border border-gray-100 bg-gray-50 p-3">
                    <span class="block text-xs text-gray-500">Razorpay Payment ID</span>
                    <span class="block font-mono text-xs font-semibold text-gray-800 break-all select-all">{{ $registration->razorpay_payment_id ?? 'Pending capture' }}</span>
                </div>
            </div>
        </div>

        {{-- Registered Farms --}}
        <div class="rounded-sm border border-stroke bg-white p-6 shadow-default">
            <div class="mb-4 flex items-center justify-between border-b border-gray-100 pb-2">
                <h4 class="text-base font-semibold text-gray-800">
                    <i class="fa-solid fa-seedling me-2 text-emerald-600"></i> Registered Farm / Land Addresses ({{ $registration->farms->count() }})
                </h4>
                <span class="text-sm font-semibold text-emerald-700">
                    Total: {{ number_format($registration->farms->sum('area_acres'), 2) }} Acres
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full text-left text-sm">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="p-3">#</th>
                            <th class="p-3">Village</th>
                            <th class="p-3">Taluka</th>
                            <th class="p-3">District</th>
                            <th class="p-3">State</th>
                            <th class="p-3">Pincode</th>
                            <th class="p-3">Farm Contact Mobile</th>
                            <th class="p-3 text-right">Area (Acres)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($registration->farms as $index => $farm)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-500">{{ $index + 1 }}</td>
                                <td class="p-3 font-semibold text-gray-800">{{ $farm->village }}</td>
                                <td class="p-3">{{ $farm->taluka }}</td>
                                <td class="p-3">{{ $farm->district }}</td>
                                <td class="p-3">
                                    <span class="badge badge-ghost text-xs">{{ $farm->state }}</span>
                                </td>
                                <td class="p-3">{{ $farm->pincode }}</td>
                                <td class="p-3">
                                    <a href="tel:{{ $farm->mobile }}" class="text-emerald-700 hover:underline">
                                        {{ $farm->mobile }}
                                    </a>
                                </td>
                                <td class="p-3 text-right font-semibold text-gray-900">
                                    {{ number_format($farm->area_acres, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-6 text-center text-gray-400">No farm addresses recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
