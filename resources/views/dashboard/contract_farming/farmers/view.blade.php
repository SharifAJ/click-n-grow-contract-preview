{{-- resources/views/enquiries/view.blade.php --}}
<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Enquiry Details')" />

    <div class="mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">

            <div class="overflow-x-auto">
                <div class="w-1/2 p-5">
                    <table class="table w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Name</th>
                                <td class="border border-gray-300">{{ $enquiry->name }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Email</th>
                                <td class="border border-gray-300">{{ $enquiry->email }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Mobile No.</th>
                                <td class="border border-gray-300">{{ $enquiry->mobile ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Address</th>
                                <td class="border border-gray-300">{{ $enquiry->address ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Message</th>
                                <td class="border border-gray-300">{{ $enquiry->message ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('contract_farming.enquiry.index') }}" class="btn btn-neutral mt-4 text-white">
                        Back
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
