<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Package Master Show')" />





    <div class=" mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Package Master</h4>
                <a href="{{ route('servicemaster.index') }}" class="btn btn-neutral text-white">
                    Back
                </a>
            </div>

            <div class="overflow-x-auto">

                <div class="w-1/2 p-5">
                    <table class="table w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Package Name</th>
                                <td class="border border-gray-300">{{ $packageMaster_data->name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Description</th>
                                <td class="border border-gray-300">{{ $packageMaster_data->description }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Total Services</th>
                                <td class="border border-gray-300">

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                        @foreach ($service_data as $service)
                                            <label
                                                class="flex items-center space-x-2 bg-gray-100   p-2 rounded-lg shadow-md cursor-pointer  ">

                                                <span class="text-black-900 ">{{ $service->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <!-- Box for Total Services Count -->
                                    <div class="mt-4 flex justify-left">
                                        <div
                                            class="border border-gray-500 rounded-lg   w-10 text-center bg-gray-100 shadow-md">
                                            <p class="text-2xl font-bold text-gray-700">
                                                {{ $service_data->count() ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Subscription Duration</th>
                                {{-- <td class="border border-gray-300">{{ $packageMaster_data->duration ?? 'N/A' }}
                                </td> --}}
                                <td class="border border-gray-300"> {{ implode(', ', $packageMaster_data->duration) }}
                                </td>

                            </tr>
                            <tr>
                                <th class="border border-gray-300">Amount/Acre(Rs)</th>
                                <td class="border border-gray-300">{{ $packageMaster_data->amount ?? 'N/A' }} </td>
                            </tr>
                            {{-- <tr>
                                <th class="border border-gray-300">Created Date</th>
                                <td class="border border-gray-300">
                                    {{ date('d-M-Y', strtotime($packageMaster_data->created_at ?? 'N/A')) }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Status</th>
                                <td class="border border-gray-300">{{ $packageMaster_data->status }} </td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
