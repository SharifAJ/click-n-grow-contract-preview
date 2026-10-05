<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farm Details')" />





    <div class=" mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            {{-- <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Farm Details</h4>
                <a href="{{ route('addfarm.index') }}" class="btn btn-success text-white">
                    Back
                </a>
            </div> --}}

            <div class="overflow-x-auto">

                <div class="w-1/2 p-5">
                    <table class="table   w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Farm ID</th>
                                <td class="border border-gray-300">{{ $farm_data->farm_id }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Farm Name</th>
                                <td class="border border-gray-300">{{ $farm_data->farm_name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Farmer Name</th>
                                <td class="border border-gray-300">{{ $farm_data->user_name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Farm Area</th>
                                <td class="border border-gray-300">{{  floor($farm_data->area * 10) / 10}} Acre</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Coordinates</th>
                                <td class="border border-gray-300">
                                    {{ isset($farm_data['geo_json']['geometry']['coordinates'])
                                        ? json_encode($farm_data['geo_json']['geometry']['coordinates'])
                                        : 'N/A' }}
                                </td>

                            </tr>
                            <tr>
                                <th class="border border-gray-300">Crop Type</th>
                                <td class="border border-gray-300">{{ ucfirst($farm_data->croptype) }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Crop Variety</th>
                                <td class="border border-gray-300">{{ $farm_data->crop_variety ?? 'N/A' }}</td>
                            </tr>
                            {{-- <tr>
                                <th class="border border-gray-300">Crop Age</th>
                                <td class="border border-gray-300">{{ $farm_data->crop_age ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Irrigation</th>
                                <td class="border border-gray-300">{{ $farm_data->irrigation ?? 'N/A' }}</td>
                            </tr> --}}
                            <tr>
                                <th class="border border-gray-300">Sowing Date</th>
                                <td class="border border-gray-300">
                                    {{ date('d-M-Y', strtotime($farm_data->sowingdate ?? 'N/A')) }}</td>
                            </tr>
                            {{-- <tr>
                                <th class="border border-gray-300">Subscription ID</th>
                                <td class="border border-gray-300">{{ $farm_data->subscription_code ?? 'N/A' }}</td>
                            </tr> --}}
                            {{--$farm_data)--}}
                            <tr>
                                <th class="border border-gray-300">Status</th>
                                @if ($farm_data->farm_deleted_at == null)
                                    <td class="border border-gray-300">Active</td>
                                @else
                                    <td class="border border-gray-300">Inactive</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('addfarm.index') }}" class="btn btn-neutral mt-4 text-white">
                        Back
                    </a>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
