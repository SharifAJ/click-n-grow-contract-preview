<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farmer Details')" />

    <div class=" mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            {{-- <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Farmer Details</h4>
              
            </div> --}}

            <div class="overflow-x-auto">

                <div class="w-1/2 p-5">
                    <table class="table   w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Farmer ID</th>
                                <td class="border border-gray-300">{{ $user_data->farmer_id }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Name</th>
                                <td class="border border-gray-300">{{ $user_data->name }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Email</th>
                                <td class="border border-gray-300">{{ $user_data->email }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Mobile No.</th>
                                <td class="border border-gray-300">{{ $user_data->mobile ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Total Farms</th>
                                <td class="border border-gray-300">{{ $farmer_data->count() ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Status</th>
                                @if ($user_data->deleted_at == null)
                                    <td class="border border-gray-300">Active</td>
                                @else
                                    <td class="border border-gray-300">Inactive</td>
                                @endif
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Registration Date </th>
                                <td class="border border-gray-300">
                                    {{ date('d-M-Y', strtotime($user_data->reg_date ?? 'N/A')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('farmer.index') }}" class="btn btn-neutral mt-4 text-white">
                        Back
                    </a>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
