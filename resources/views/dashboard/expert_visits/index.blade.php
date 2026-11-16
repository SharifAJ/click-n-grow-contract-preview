<x-app-layout>
    <x-header-title :title="__('Expert Visit Registrations')" />

    <div class="mt-5 rounded-sm border border-stroke bg-white p-6 shadow-default">
        {{-- Header description & count badges --}}
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Pre-Sowing Expert Visit Registrations</h3>
                <p class="text-sm text-gray-500">Track farmer registrations, visit requests, farm details, and Razorpay payment status.</p>
            </div>
        </div>

        {{-- Session Flash Alerts --}}
        @if (session('success'))
            <div class="alert alert-success mb-4 rounded-md p-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error mb-4 rounded-md p-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($dbError))
            <div class="mb-4 rounded-md border border-amber-300 bg-amber-50 p-4 text-amber-900">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation mt-0.5 text-amber-600"></i>
                    <div>
                        <p class="font-semibold">Expert Visits Database Notice</p>
                        <p class="text-sm">{{ $dbError }}</p>
                        @if (!$connectionConfigured)
                            <p class="mt-1 text-xs text-amber-700">Set <code>REGISTRATION_DB_HOST</code>, <code>REGISTRATION_DB_DATABASE</code>, and <code>REGISTRATION_DB_USERNAME</code> in your environment / Render configuration.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Filter and Search Controls --}}
        @if ($connectionConfigured && empty($dbError))
            <div class="mb-6 flex flex-col gap-4 border-b border-gray-200 pb-5 lg:flex-row lg:items-center lg:justify-between">
                {{-- Status Pills --}}
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.expert-visits.index', array_merge(request()->except('status', 'page'), [])) }}"
                       class="btn btn-sm {{ !request()->filled('status') ? 'btn-primary' : 'btn-outline' }}">
                        All ({{ $statusCounts['all'] }})
                    </a>
                    <a href="{{ route('admin.expert-visits.index', array_merge(request()->except('page'), ['status' => 'paid'])) }}"
                       class="btn btn-sm {{ request('status') === 'paid' ? 'btn-success text-white' : 'btn-outline' }}">
                        Paid ({{ $statusCounts['paid'] }})
                    </a>
                    <a href="{{ route('admin.expert-visits.index', array_merge(request()->except('page'), ['status' => 'pending'])) }}"
                       class="btn btn-sm {{ request('status') === 'pending' ? 'btn-warning text-white' : 'btn-outline' }}">
                        Pending ({{ $statusCounts['pending'] }})
                    </a>
                    <a href="{{ route('admin.expert-visits.index', array_merge(request()->except('page'), ['status' => 'order_failed'])) }}"
                       class="btn btn-sm {{ request('status') === 'order_failed' ? 'btn-error text-white' : 'btn-outline' }}">
                        Failed ({{ $statusCounts['order_failed'] }})
                    </a>
                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('admin.expert-visits.index') }}" class="flex items-center gap-2">
                    @if (request()->filled('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search applicant, phone, reference..."
                               class="input input-bordered input-sm w-64 pr-8">
                        @if (request()->filled('search'))
                            <a href="{{ route('admin.expert-visits.index', request()->except('search', 'page')) }}"
                               class="absolute right-2 top-2 text-xs text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-times"></i>
                            </a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
            </div>
        @endif

        {{-- Table --}}
        @if ($registrations && $registrations->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="table w-full text-left text-sm">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="p-3">Applicant</th>
                            <th class="p-3">Contact</th>
                            <th class="p-3">Residential Location</th>
                            <th class="p-3">Farms</th>
                            <th class="p-3">Preferred Visit</th>
                            <th class="p-3">Fee</th>
                            <th class="p-3">Payment</th>
                            <th class="p-3">Submitted</th>
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($registrations as $reg)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">
                                    {{ $reg->name }} {{ $reg->surname }}
                                    <span class="block text-xs font-normal text-gray-500">S/O: {{ $reg->father_name }}</span>
                                    <span class="block font-mono text-[11px] text-gray-400" title="Reference UUID">{{ Str::limit($reg->reference, 13) }}</span>
                                </td>
                                <td class="p-3">
                                    <a href="tel:{{ $reg->mobile }}" class="font-medium text-emerald-700 hover:underline">
                                        {{ $reg->mobile }}
                                    </a>
                                </td>
                                <td class="p-3 text-gray-700">
                                    {{ $reg->residential_village }}, {{ $reg->residential_district }}
                                    <span class="block text-xs text-gray-500">{{ $reg->residential_state }} - {{ $reg->residential_pincode }}</span>
                                </td>
                                <td class="p-3">
                                    <span class="badge badge-neutral text-xs">
                                        {{ $reg->farms->count() }} {{ Str::plural('Farm', $reg->farms->count()) }}
                                    </span>
                                    <span class="block text-xs text-gray-500">
                                        Total: {{ number_format($reg->farms->sum('area_acres'), 1) }} acres
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="font-medium text-gray-800">{{ $reg->preferred_visit_date?->format('d M Y') ?? '—' }}</span>
                                    <span class="block text-xs text-gray-500">{{ $reg->visit_days }} {{ Str::plural('day', $reg->visit_days) }}</span>
                                </td>
                                <td class="p-3 font-semibold text-gray-900">
                                    ₹{{ number_format($reg->total_fee) }}
                                    <span class="block text-xs font-normal text-gray-500">₹{{ number_format($reg->fee_per_day) }}/day</span>
                                </td>
                                <td class="p-3">
                                    @if ($reg->payment_status === 'paid')
                                        <span class="badge badge-success text-xs text-white">Paid</span>
                                    @elseif ($reg->payment_status === 'order_failed')
                                        <span class="badge badge-error text-xs text-white">Order Failed</span>
                                    @else
                                        <span class="badge badge-warning text-xs text-white">Pending</span>
                                    @endif
                                </td>
                                <td class="p-3 text-xs text-gray-500">
                                    {{ $reg->created_at?->format('d M Y, h:i A') ?? '—' }}
                                </td>
                                <td class="p-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.expert-visits.show', $reg->id) }}"
                                           class="btn btn-xs btn-outline btn-info">
                                            <i class="fa-solid fa-eye"></i> View
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.expert-visits.destroy', $reg->id) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this registration?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-outline btn-error" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $registrations->links() }}
            </div>
        @elseif ($connectionConfigured && empty($dbError))
            <div class="py-12 text-center text-gray-500">
                <i class="fa-solid fa-clipboard-question mb-3 text-4xl text-gray-300"></i>
                <p class="text-base font-medium">No expert visit registrations found.</p>
                <p class="text-xs text-gray-400">Submissions made from the public form will appear here.</p>
            </div>
        @endif
    </div>
</x-app-layout>
