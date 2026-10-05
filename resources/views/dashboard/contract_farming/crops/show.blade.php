<x-app-layout>
    <x-header-title :title="__('Crop Details')" />

    <div class="mt-5">
    <div class="rounded border bg-white shadow">
        <div class="p-6 space-y-4">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <tbody>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Icon</th>
                        <td class="border p-2 text-left text-2xl">{{ $crop->icon }}</td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Name</th>
                        <td class="border p-2 text-left">{{ $crop->name }}</td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Description</th>
                        <td class="border p-2 text-left">{{ $crop->description }}</td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Details</th>
                        <td class="border p-2 text-left">{{ $crop->details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Sowing Months</th>
                        <td class="border p-2 text-left">
                            {{ implode(', ', is_array($crop->sowing_months) ? $crop->sowing_months : json_decode($crop->sowing_months, true) ?? []) ?: 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">English PDF</th>
                        <td class="border p-2 text-left">
                            @if($crop->pdf_en)
                                <a href="{{ asset('storage/' . $crop->pdf_en) }}" class="text-blue-600 underline" target="_blank">View English PDF</a>
                            @else 
                                N/A 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="border p-2 w-1/4 text-left font-medium">Hindi PDF</th>
                        <td class="border p-2 text-left">
                            @if($crop->pdf_hi)
                                <a href="{{ asset('storage/' . $crop->pdf_hi) }}" class="text-blue-600 underline" target="_blank">View Hindi PDF</a>
                            @else 
                                N/A 
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Images --}}
            <div>
                <h4 class="font-semibold mb-2">Crop Images</h4>
                <div class="flex gap-4 flex-wrap">
                    @if($crop->images)
                        @foreach(json_decode($crop->images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" class="w-40 h-32 object-cover rounded border" />
                        @endforeach
                    @else
                        <p>No images available.</p>
                    @endif
                </div>
            </div>

            <a href="{{ route('contract_farming.crops.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 mt-4 inline-block">
                Back
            </a>
        </div>
    </div>
</div>

</x-app-layout>
