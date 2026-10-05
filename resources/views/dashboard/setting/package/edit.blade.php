<x-app-layout>
    <x-header-title :title="__('Edit Package Master Details')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class=" mt-5">
        <form method="POST" action="{{ route('packagemaster.update', $package->id) }}" class="kisansat_form">
            @csrf
            @method('PUT')

            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Edit Package Master Details</h4>
                </div>

                <div class="w-1/2 p-5">
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Package Name<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $package->name) }}"
                            placeholder="Enter Package Name" class="input input-bordered w-full" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input type="text" name="description" value="{{ old('description', $package->description) }}"
                            placeholder="Enter Description" class="input input-bordered w-full">
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text font-semibold text-lg">Select Services<span
                                    class="text-red-500">*</span></span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($service_data as $item)
                                <label
                                    class="flex items-center space-x-2 bg-gray-100   p-2 rounded-lg shadow-md cursor-pointer   ">
                                    <input type="checkbox" name="services[]" value="{{ $item->id }}"
                                        class="checkbox checkbox-primary"
                                        {{ in_array($item->id, $selected_services) ? 'checked' : '' }}>
                                    <span class="text-black-900 ">{{ $item->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('services')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Subscription Duration<span class="text-red-500">*</span></span>
                        </label>
                        <select name="duration" class="select select-bordered w-full" required>
                            <option value="" disabled
                                {{ old('duration', $package->duration) ? '' : 'selected' }}>
                                Select Time Duration</option>
                            <option value="12" {{ old('duration', $package->duration) == '12' ? 'selected' : '' }}>
                                12 Months</option>
                            <option value="6" {{ old('duration', $package->duration) == '6' ? 'selected' : '' }}>6
                                Months</option>
                            <option value="1" {{ old('duration', $package->duration) == '1' ? 'selected' : '' }}>1
                                Month</option>
                            <option value="-1" {{ old('duration', $package->duration) == '-1' ? 'selected' : '' }}>
                                Lifetime</option>

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
                            value="{{ old('amount', $package->amount) }}" placeholder="Enter Amount"
                            class="input input-bordered w-full" required pattern="^\d+(\.\d{0,2})?$"
                            oninput="validateDecimal(this)">
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

    {{-- for select atlist one service --}}
    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let checkboxes = document.querySelectorAll('input[name="services[]"]:checked');
            if (checkboxes.length === 0) {
                event.preventDefault();
                alert("Please select at least one service.");
            }
        });
    </script>
    <script>
        function validateDecimal(input) {
            input.value = input.value.replace(/[^0-9.]/g, '') // Allow only numbers and dot
                .replace(/(\..*)\./g, '$1') // Prevent multiple dots
                .replace(/^0+(?=\d)/, '') // Prevent leading zeros
                .match(/^\d*(\.\d{0,2})?/g)?.[0] || ''; // Restrict to 2 decimals
        }
    </script>
</x-app-layout>
