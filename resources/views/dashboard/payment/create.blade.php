<x-app-layout>
    <x-header-title :title="__('Add Payment Details')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class=" mt-5">
        <form method="POST" action="{{ route('payment.store') }}">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Payment Details</h4>
                </div>

                @csrf
                <div class="w-1/2 p-5">
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Farmer</span>
                        </label>
                        <input type="text" value="{{ $farmers->name }}" readonly
                            class="input input-bordered w-full" />
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Farmer ID</span>
                        </label>
                        <input type="text" value="{{ $farmers->farmer_id }}" readonly
                            class="input input-bordered w-full" />
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Mobile</span>
                        </label>
                        <input type="text" value="{{ $farmers->mobile }}" readonly
                            class="input input-bordered w-full" />
                    </div>
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" value="{{ $farmers->email }}" readonly
                            class="input input-bordered w-full" />
                    </div>


                    @php
                        $date = date('Y-M-d');
                    @endphp
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Payment Date <span class="text-red-500">*</span></span>
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
                            <span class="label-text">Payment Status <span class="text-red-500">*</span></span>
                        </label>
                        <select class="select select-bordered w-full" name="payment_status[]" required>
                            <option value="" selected disabled>Select Payment Status</option>
                            <option value="upi">UPI</option>
                            <option value="bank-transfer">Bank Transfer</option>
                            <option value="card">Card</option>
                            <option value="cash">Cash</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Remark <span class="text-red-500">*</span></span>
                        </label>
                        <textarea name="" rows="5" cols="4" class="textarea textarea-bordered w-full"></textarea>
                    </div>


                </div>


                
                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="{{ route('payment.index') }}" class="btn btn-neutral">Back</a>
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
