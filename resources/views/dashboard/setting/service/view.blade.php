<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Service Master Show')" />





    <div class="  mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Service Master</h4>
                <a href="{{ route('servicemaster.index') }}" class="btn btn-neutral text-white">
                    Back
                </a>
            </div>

            <div class="overflow-x-auto">

                <div class="w-1/2 p-5">
                    <table class="table   w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Service Name</th>
                                <td class="border border-gray-300">{{ $ServiceMaster_data->name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Description</th>
                                <td class="border border-gray-300">{{ $ServiceMaster_data->description }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Time Duration</th>
                                <td class="border border-gray-300">
                                    {{ implode(', ', $ServiceMaster_data->duration) }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Service Type</th>
                                <td class="border border-gray-300">{{ $ServiceMaster_data->service_type }} </td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Amount/Acre (Rs)</th>
                                <td class="border border-gray-300">{{ $ServiceMaster_data->amount ?? 'N/A' }} </td>
                            </tr>
                            {{-- <tr>
                                <th class="border border-gray-300">Date</th>
                                <td class="border border-gray-300">
                                    {{ date('d-M-Y', strtotime($ServiceMaster_data->created_at ?? 'N/A')) }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Status</th>
                                <td class="border border-gray-300">{{ $ServiceMaster_data->status }} </td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
