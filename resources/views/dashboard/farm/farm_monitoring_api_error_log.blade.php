<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farm Monitoring API Error Log')" />





    <div class=" mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            {{-- <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Farm Details</h4>
                <a href="{{ route('addfarm.index') }}" class="btn btn-success text-white">
                    Back
                </a>
            </div> --}}

            <div class="overflow-x-auto">

                <div class="w-full p-5">
                    <table class="table border border-gray-300">
                        <thead>
                            <tr>
                                <td class="border border-gray-300">#</td>
                                <td class="border border-gray-300">Report Generated At</td>
                                <td class="border border-gray-300">Service Name</td>
                                <td class="border border-gray-300">Report Updated At</td>
                                <td class="border border-gray-300">API Report Status</td>
                                <td class="border border-gray-300">API Count</td>
                                <td class="border border-gray-300">Error Message (if any)</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td class="border border-gray-300">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($data->created_at)) }}</td>
                                    <td class="border border-gray-300">{{ ucfirst($data->service_type) }}</td>
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($data->updated_at)) }}</td>
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($data->created_at)) }}</td>

                                    <td class="border border-gray-300">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300">{{ $data->error_message }}</td>
                                </tr>
                            @endforeach

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
