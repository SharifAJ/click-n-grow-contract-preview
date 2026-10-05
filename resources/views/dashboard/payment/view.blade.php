<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farmer Show')" />

    <div class="container mx-auto mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Farmer Details</h4>
                <a href="{{ route('farmer.index') }}" class="btn btn-neutral text-white">
                    Back
                </a>
            </div>

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
                                <th class="border border-gray-300">Last Name</th>
                                <td class="border border-gray-300">{{ $user_data->last_name ?? 'N/A' }}</td>
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
                                <th class="border border-gray-300">Registration Date </th>
                                <td class="border border-gray-300">
                                    {{ date('d-M-Y', strtotime($user_data->reg_date ?? 'N/A')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
