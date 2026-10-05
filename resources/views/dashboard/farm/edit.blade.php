<x-app-layout>
    <x-header-title :title="__('Add Farm Details')" />

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class=" mt-5">
        <form method="POST" action="{{ route('addfarm.update', $farm_data->id) }}" class="kisansat_form">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between items-center p-4">
                    <h4 class="text-lg font-semibold">Farmer Details</h4>
                </div>

                @csrf
                @method('PUT')
                <div class="w-1/2 p-5">

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Farmer Name<span class="text-red-500">*</span></span>
                        </label>
                        <select name="user_id" id="selec_farmer" class="select select-bordered w-full" required>
                            <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>Select Farmer
                            </option>
                            @foreach ($farmer_data as $f_data)
                                <option value="{{ $f_data->id }}"
                                    {{ $farm_data->user_id == $f_data->id ? 'selected' : '' }}>
                                    {{ $f_data->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Farm Name <span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $farm_data->name) }}"
                            placeholder="Name of the farm" class="input input-bordered w-full" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Coordinate<span class="text-red-500">*</span></span>
                        </label>

                        <textarea name="coordinates" id="" placeholder="Enter Coordinates" rows="4"
                            class="textarea textarea-bordered w-full" required>
                            {{ old('coordinates', json_encode($farm_data['geo_json']['geometry']['coordinates'])) }}
                        </textarea>

                        @error('coordinates')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Croptype<span class="text-red-500">*</span></span>
                        </label>
                        <select name="croptype" id="croptype_id" class="select select-bordered w-full" required>
                            <option value="" disabled {{ old('croptype') ? '' : 'selected' }}>Select Croptype
                            </option>
                            @foreach ($crop_data as $data)
                                <option value="{{ $data->crop_name }}"
                                    {{ $farm_data->croptype == $data->crop_name ? 'selected' : '' }}>
                                    {{ $data->crop_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('croptype')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>




                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Category<span class="text-red-500">*</span></span>
                        </label>
                        <select name="category" class="select select-bordered w-full" required>
                            <option value="" disabled>Select Category</option>
                            <option value="farm" {{ $farm_data->category == 'farm' ? 'selected' : '' }}>Farm</option>
                            <option value="garden" {{ $farm_data->category == 'garden' ? 'selected' : '' }}>Garden
                            </option>
                            <option value="polyhouse" {{ $farm_data->category == 'polyhouse' ? 'selected' : '' }}>
                                Polyhouse
                            </option>
                            <option value="tank" {{ $farm_data->category == 'tank' ? 'selected' : '' }}>Tank</option>
                        </select>
                        @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    @php
                        $date = date('d-m-Y'); // Correct format for validation
                    @endphp
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Sowing Date<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" name="sowingdate"
                            value="{{ old('sowingdate', \Carbon\Carbon::parse($farm_data->sowingdate)->format('d-m-Y')) }}"
                            class="input input-bordered w-full" required placeholder="dd-mm-yyyy">
                        @error('sowingdate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Crop Variety</span>
                        </label>
                        <input type="text" name="crop_variety"
                            value="{{ old('crop_variety', $farm_data->crop_variety) }}"
                            placeholder="Enter Crop Variety" class="input input-bordered w-full">
                        @error('crop_variety')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>



                <div class="flex items-center p-4 justify-end space-x-4">
                    <a href="{{ route('addfarm.index') }}" class="btn btn-neutral">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            $('#selec_farmer').select2();
            $('#croptype_id').select2();
        });
    </script>
</x-app-layout>
