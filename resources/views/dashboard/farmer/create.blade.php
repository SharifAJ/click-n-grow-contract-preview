<x-app-layout>
    <x-header-title :title="__('Add Farmer Details')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class=" mt-5">
        <form method="POST" action="{{ route('farmer.store') }}">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Farmer Details</h4>
                </div>

                @csrf
                <div class="w-1/2 p-5">
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
                     

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Email <span class="text-red-500">*</span></span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                            class="input input-bordered w-full" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Mobile No. <span class="text-red-500">*</span></span>
                        </label>
                        <input type="tel" name="mobile" value="{{ old('mobile') }}"
                            class="input input-bordered w-full" pattern="[0-9]{10}" oninput="validateMobile(this)"
                            maxlength="10" placeholder="Enter 10-digit mobile number" required>
                        @error('mobile')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    @php
                        $date = date('Y-M-d');
                    @endphp
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Registration Date <span class="text-red-500">*</span></span>
                        </label>
                        <input type="date" name="reg_date"
                            value="{{ old('reg_date', $date ? date('Y-m-d', strtotime($date)) : '') }}"
                            class="input input-bordered w-full" required>
                        @error('reg_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Password <span class="text-red-500">*</span></span>
                        </label>
                        <input type="password" name="password" placeholder="Enter password"
                            class="input input-bordered w-full" required>
                        {{-- <p class="text-gray-600 text-sm mt-1">
                            Must include **uppercase, lowercase, special character & number** (e.g.,
                            <b>Password@1234</b>)
                        </p> --}}
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Confirm Password <span class="text-red-500">*</span></span>
                        </label>
                        <input type="password" name="password_confirmation"
                            placeholder="Enter Confirm password" class="input input-bordered w-full"
                            required>
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="{{ route('farmer.index') }}" class="btn btn-neutral">Back</a>
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
