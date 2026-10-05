<x-app-layout>
    <x-header-title :title="__('Add Enquiry')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-5">
        <form method="POST" action="{{ route('contract_farming.enquiry.store') }}">
            @csrf
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Enquiry Details</h4>
                </div>

                <div class="w-1/2 p-5">
                    {{-- Name --}}
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Name <span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name"
                               class="input input-bordered w-full" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                               class="input input-bordered w-full">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mobile --}}
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Mobile No. <span class="text-red-500">*</span></span>
                        </label>
                        <input type="tel" name="mobile" value="{{ old('mobile') }}"
                               class="input input-bordered w-full" pattern="[0-9]{10}"
                               oninput="validateMobile(this)" maxlength="10"
                               placeholder="Enter 10-digit mobile number" required>
                        @error('mobile')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Address</span>
                        </label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter address"
                               class="input input-bordered w-full">
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Message --}}
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Message</span>
                        </label>
                        <textarea name="message" placeholder="Enter your message"
                                  class="textarea textarea-bordered w-full">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="{{ route('contract_farming.enquiry.index') }}" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function validateMobile(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 10);
        }
    </script>
</x-app-layout>
