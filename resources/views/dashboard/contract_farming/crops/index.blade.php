<x-app-layout>
    <x-header-title :title="__('Contract Farming Crops')" />

    <div class="mt-5">
        <div class="flex justify-end mb-4">
            <a href="{{ route('contract_farming.crops.create') }}"
               class="bg-green-700 text-white border-green-600 hover:bg-green-600 hover:border-green-700 font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                Add New Crop
            </a>
        </div>

        <div class="border-stroke shadow-default dark:border-strokedark dark:bg-boxdark rounded-sm border bg-white">
            <div class="w-full p-7 bg-white">
                <table class="table" id="crops_Table">
                    <thead class="text-primary-content">
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Details</th>
                            <th>Sowing Months</th>
                            <th>English PDF</th>
                            <th>Hindi PDF</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crops as $crop)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-2xl">{!! $crop->icon !!}</td>
                                <td>{{ $crop->name }}</td>
                                <td>{{ Str::limit($crop->description, 50) }}</td>
                                <td>{{ Str::limit($crop->details, 50) }}</td>
                                <td>
                                    @if(!empty($crop->sowing_months))
                                        {{ implode(', ', is_array($crop->sowing_months) ? $crop->sowing_months : json_decode($crop->sowing_months, true) ?? []) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($crop->pdf_en)
                                        <a href="{{ asset('storage/' . $crop->pdf_en) }}" target="_blank" class="text-blue-500 underline">View</a>
                                    @else N/A @endif
                                </td>
                                <td>
                                    @if($crop->pdf_hi)
                                        <a href="{{ asset('storage/' . $crop->pdf_hi) }}" target="_blank" class="text-blue-500 underline">View</a>
                                    @else N/A @endif
                                </td>
                                <td class="flex">
                                    <a href="{{ route('contract_farming.crops.show', $crop->id) }}" class="text-blue-500 underline"><i class="fas fa-eye text-2xl px-2"></i></a>
                                    <a href="{{ route('contract_farming.crops.edit', $crop->id) }}" class="text-green-500 underline"><i class="fas fa-edit text-2xl px-2"></i></a>
                                    <!-- Delete -->
                                    <form action="{{ route('contract_farming.crops.destroy', $crop->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-500 underline bg-transparent p-0 m-0 border-0 cursor-pointer">
                                            <i type="button" class="fa-solid fa-trash text-2xl px-2  delete-button"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                new DataTable("#crops_Table", {
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    fixedColumns: { left: 1, right: 1 },
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    responsive: true,
                    layout: {
                        topStart: {
                            buttons: [
                                { extend: "pageLength" },
                                
                            ]
                        }
                    }
                });
            });
        </script>
    </div>
</x-app-layout>
