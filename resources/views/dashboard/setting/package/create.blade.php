<x-app-layout>
    <x-header-title :title="__('Add Package Master Details')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class=" mt-5">
        <form method="POST" action="{{ route('packagemaster.store') }}" class="kisansat_form">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Package Master Details</h4>
                </div>

                @csrf
                <div class="w-1/2 p-5">
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Package Name<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Enter Service Name" class="input input-bordered w-full" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input type="text" name="description" value="{{ old('description') }}"
                            placeholder="Enter Description" class="input input-bordered w-full">
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text font-semibold text-lg">Select Services</span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($service_data as $item)
                                <label
                                    class="flex items-center space-x-2 bg-gray-100   p-2 rounded-lg shadow-md cursor-pointer  ">
                                    <input type="checkbox" name="services[]" value="{{ $item->id }}"
                                        class="checkbox checkbox-primary"
                                        {{ in_array($item->id, old('services', [])) ? 'checked' : '' }}>
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
                            <option value="" disabled {{ old('duration') ? '' : 'selected' }}>Select
                                Time
                                Duration
                            </option>

                            {{-- <option value="3"
                                {{ collect(old('duration'))->contains('3') ? 'selected' : '' }}>3 Months
                            </option> --}}
                            <option value="12"
                                {{ collect(old('duration'))->contains('12') ? 'selected' : '' }}>12 Months
                            </option>
                            <option value="6"
                                {{ collect(old('duration'))->contains('6') ? 'selected' : '' }}>6 Months
                            </option>
                            <option value="1"
                                {{ collect(old('duration'))->contains('1') ? 'selected' : '' }}>1 Month
                            </option>
                            <option value="-1"
                                {{ collect(old('duration'))->contains('-1') ? 'selected' : '' }}>
                                Lifetime</option>
                            {{-- <option value="once"
                                {{ collect(old('duration'))->contains('once') ? 'selected' : '' }}>One-Time
                                Use</option> --}}
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
                            value="{{ old('amount') ?? ($service->amount ?? '') }}" placeholder="Enter Amount"
                            class="input input-bordered w-full" required pattern="^\d+(\.\d{0,2})?$"
                            oninput="validateDecimal(this)">

                        @error('amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                </div>



                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="{{ route('servicemaster.index') }}" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
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
</x-app-layout>
