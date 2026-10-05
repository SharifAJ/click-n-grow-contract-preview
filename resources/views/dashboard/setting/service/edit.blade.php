<x-app-layout>
    <x-header-title :title="__('Edit Service Master Details')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="  mt-5">
        <form method="POST" action="{{ route('servicemaster.update', $serviceMaster->id) }}" class="kisansat_form">
            @csrf
            @method('PUT') {{-- Use PUT method for updating --}}

            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Edit Service Master Details</h4>
                </div>

                <div class="w-1/2 p-5">
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Service Name<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') ?? ($serviceMaster->name ?? '') }}"
                            placeholder="Enter Service Name" class="input input-bordered w-full" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input type="text" name="description"
                            value="{{ old('description') ?? ($serviceMaster->description ?? '') }}"
                            placeholder="Enter Description" class="input input-bordered w-full">
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Service Type<span class="text-red-500">*</span></span>
                        </label>
                        <select name="service_type" class="select select-bordered w-full" required>
                            <option value="" disabled
                                {{ old('service_type', $serviceMaster->service_type) ? '' : 'selected' }}>Select Service
                                Type</option>
                            <option value="premium"
                                {{ old('service_type', $serviceMaster->service_type) == 'premium' ? 'selected' : '' }}>
                                Premium</option>
                            <option value="free"
                                {{ old('service_type', $serviceMaster->service_type) == 'free' ? 'selected' : '' }}>Free
                            </option>
                        </select>
                        @error('service_type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Time Duration<span class="text-red-500">*</span></span>
                        </label>
                        <select name="duration[]" class="select select-bordered w-full" required>
                            <option value="" disabled {{ old('duration') ? '' : 'selected' }}>Select
                                Time
                                Duration
                            </option>
                            <option value="1"
                                {{ in_array('1', $serviceMaster->duration ?? []) ? 'selected' : '' }}>1 Month
                            </option>
                            {{-- <option value="3"
                                {{ in_array('3', $serviceMaster->duration ?? []) ? 'selected' : '' }}>3 Months
                            </option> --}}
                            <option value="6"
                                {{ in_array('6', $serviceMaster->duration ?? []) ? 'selected' : '' }}>6 Months
                            </option>
                            <option value="12"
                                {{ in_array('12', $serviceMaster->duration ?? []) ? 'selected' : '' }}>12
                                Months
                            </option>
                            <option value="lifetime"
                                {{ in_array('lifetime', $serviceMaster->duration ?? []) ? 'selected' : '' }}>
                                Lifetime</option>
                            {{-- <option value="free"
                                {{ in_array('free', $serviceMaster->duration ?? []) ? 'selected' : '' }}>Free
                            </option> --}}
                            {{-- <option value="once"
                                {{ in_array('once', $serviceMaster->duration ?? []) ? 'selected' : '' }}>
                                One-Time Use</option> --}}

                        </select>

                        @error('duration')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Amount <span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="amount" id="amount"
                            value="{{ old('amount', number_format($serviceMaster->amount, 2)) }}"
                            placeholder="Enter Amount" class="input input-bordered w-full" required
                            pattern="^\d+(\.\d{0,2})?$" oninput="validateDecimal(this)">
                        @error('amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="{{ route('servicemaster.index') }}" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function validateDecimal(input) {
            // Only allow numbers with up to 2 decimal places
            input.value = input.value.replace(/[^0-9.]/g, '') // Allow only numbers and dot
                .replace(/(\..*)\./g, '$1') // Prevent multiple dots
                .replace(/^0+(?=\d)/, '') // Prevent leading zeros
                .match(/^\d*(\.\d{0,2})?/g)?.[0] || ''; // Restrict to 2 decimals
        }
    </script>
</x-app-layout>
