<x-app-layout>
    <x-header-title :title="__('Edit Crop')" />

    <div class="mt-5">
        <form action="{{ route('contract_farming.crops.update', $crop->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6 bg-white p-6 rounded shadow">
                <!-- Crop Icon -->
                {{-- <div>
                    <label for="icon">Crop Icon (Emoji)</label>
                    <input type="text" name="icon" id="icon" class="form-input w-full"
                        value="{{ old('icon', $crop->icon) }}" required>
                </div> --}}

                <!-- Crop Name -->
                <div>
                    <label for="name">Crop Name<span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" class="form-input w-full"
                        value="{{ old('name', $crop->name) }}" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description">Description<span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" class="form-textarea w-full" rows="4" required>{{ old('description', $crop->description) }}</textarea>
                </div>

                <!-- Details -->
                <div>
                    <label for="details">Details<span class="text-red-500">*</span></label>
                    <textarea name="details" id="details" class="form-textarea w-full" rows="4">{{ old('details', $crop->details) }}</textarea>
                </div>

                @php
                    $months = [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December',
                    ];
                    $selected_months = $crop->sowing_months ?? [];
                @endphp

                <!-- Sowing Months -->
                <div class="space-y-2">
                    <label class="font-semibold">Sowing Months<span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($months as $month)
                            <label class="inline-flex items-center space-x-2">
                                <input type="checkbox" name="sowing_months[]" value="{{ $month }} "
                                    {{ in_array($month, $selected_months) ? 'checked' : '' }}>
                                <span>{{ $month }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- PDF Uploads -->
                <div>
                    <label for="pdf_en">English PDF <span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_en" id="pdf_en" class="form-input w-full"
                        accept="application/pdf" onchange="validatePDF(this)">
                    @if ($crop->pdf_en)
                        <p class="text-sm text-gray-600 mt-1">
                            Current:
                            <a href="{{ asset('storage/' . $crop->pdf_en) }}" target="_blank"
                                class="underline text-blue-600">View</a>
                        </p>
                    @endif
                </div>

                <div>
                    <label for="pdf_hi">Hindi PDF <span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_hi" id="pdf_hi" class="form-input w-full"
                        accept="application/pdf" onchange="validatePDF(this)">
                    @if ($crop->pdf_hi)
                        <p class="text-sm text-gray-600 mt-1">
                            Current:
                            <a href="{{ asset('storage/' . $crop->pdf_hi) }}" target="_blank"
                                class="underline text-blue-600">View</a>
                        </p>
                    @endif
                </div>

                <script>
                    function validatePDF(input) {
                        const file = input.files[0];
                        if (file && file.type !== 'application/pdf') {
                            alert('Please select a valid PDF file.');
                            input.value = ''; // Clear the invalid file
                        }
                    }
                </script>

                <!-- Existing Images -->
                <div>
                    <label for="images">Crop Images (optional)</label>
                    <input type="file" name="images[]" id="images" class="form-input w-full" multiple accept="image/*">

                    @if ($crop->images)
                        <p class="text-sm text-gray-600 mt-2">Existing Images:</p>
                        <div class="flex flex-wrap gap-2 mt-1" id="existing-images">
                            @foreach (json_decode($crop->images) as $img)
                                <div class="relative w-24 h-24 border rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $img) }}" class="object-cover w-full h-full">
                                    <button type="button" class="absolute top-0 right-0 bg-red-600 text-white text-xs w-6 h-6 rounded-full"
                                            onclick="removeExistingImage(this, '{{ asset('storage/' . $img) }}')">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- New Image Previews -->
                <div id="preview-container" class="mt-4 flex flex-wrap gap-4"></div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        // Handle new image selection
        const input = document.getElementById('images');
        const previewContainer = document.getElementById('preview-container');
        let allFiles = [];

        input.addEventListener('change', function() {
            const selectedFiles = Array.from(this.files);
            const combinedFiles = [...allFiles, ...selectedFiles];

            if (combinedFiles.length > 12) {
                alert('You can only upload up to 12 images.');
                return;
            }

            allFiles = combinedFiles;
            updatePreviews();
        });

        function updatePreviews() {
            previewContainer.innerHTML = '';
            allFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative w-24 h-24 border rounded overflow-hidden';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.className = 'absolute top-0 right-0 bg-red-600 text-white w-5 h-5 text-xs rounded-full';
                    removeBtn.onclick = () => {
                        allFiles.splice(index, 1);
                        updatePreviews();
                    };

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    previewContainer.appendChild(div);
                };

                reader.readAsDataURL(file);
            });
        }

        function removeExistingImage(button, imgUrl) {
            // Implement logic to remove image from the preview and also update image list (or handle delete)
            console.log(`Remove image with URL: ${imgUrl}`);
            button.closest('div').remove();
        }
    </script>
</x-app-layout>
