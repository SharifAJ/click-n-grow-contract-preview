<x-app-layout>
    <x-header-title :title="__('Add New Crop')" />

    <div class="mt-5">


        {{-- @dd($errors); --}}
        {{-- @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contract_farming.crops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6 bg-white p-6 rounded shadow">
                {{-- <div>
                    <label for="icon">Crop Icon (Emoji)</label>
                    <input type="text" name="icon" id="icon" class="form-input w-full" required />
                </div> --}}

                <div>
                    <label for="name">Crop Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" class="form-input w-full" required />
                </div>

                <div>
                    <label for="description">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" class="form-textarea w-full" rows="4" required></textarea>
                </div>

                <div class="space-y-2">
                    <label class="font-semibold">Sowing Months <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-2" required>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="January" class="form-checkbox">
                            <span>January</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="February" class="form-checkbox">
                            <span>February</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="March" class="form-checkbox">
                            <span>March</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="April" class="form-checkbox">
                            <span>April</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="May" class="form-checkbox">
                            <span>May</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="June" class="form-checkbox">
                            <span>June</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="July" class="form-checkbox">
                            <span>July</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="August" class="form-checkbox">
                            <span>August</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="September" class="form-checkbox">
                            <span>September</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="October" class="form-checkbox">
                            <span>October</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="November" class="form-checkbox">
                            <span>November</span>
                        </label>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="sowing_months[]" value="December" class="form-checkbox">
                            <span>December</span>
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">
                        Selected: <span id="selected-months"></span>
                    </p>
                </div>

                <script>
                const monthCheckboxes = document.querySelectorAll('input[name="sowing_months[]"]');
                const selectedSpan = document.getElementById('selected-months');

                function updateSelectedMonths() {
                    const selected = Array.from(monthCheckboxes)
                                        .filter(cb => cb.checked)
                                        .map(cb => cb.value);
                    selectedSpan.textContent = selected.join(', ');
                }

                monthCheckboxes.forEach(cb => cb.addEventListener('change', updateSelectedMonths));
                </script>



                <div>
                    <label for="details">Details<span class="text-red-500">*</span></label>
                    <textarea name="details" id="details" class="form-textarea w-full" rows="4" required></textarea>
                </div>

                <div>
                    <label for="pdf_en">English PDF<span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_en" id="pdf_en" class="form-input w-full" accept="application/pdf" required/>
                </div>

                <div>
                    <label for="pdf_hi">Hindi PDF<span class="text-red-500">*</span></label>
                    <input type="file" name="pdf_hi" id="pdf_hi" class="form-input w-full" accept="application/pdf" required/>
                </div>

                <div>
                    <label for="images">Crop Images<span class="text-red-500">*</span></label>
                    <input 
                        type="file" 
                        name="images[]" 
                        id="images" 
                        multiple 
                        accept="image/*"
                        class="form-input w-full" 
                        required
                    />
                    <p class="text-sm text-gray-500 mt-1">You can upload up to 12 images. Only JPG, PNG, GIF.</p>
                    <div id="preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>

    <script>
        const input = document.getElementById('images');
        const preview = document.getElementById('preview-container');
        let allFiles = [];

        input.addEventListener('change', function () {
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
            preview.innerHTML = '';
            const dataTransfer = new DataTransfer();

            allFiles.forEach((file, index) => {
                dataTransfer.items.add(file);

                const reader = new FileReader();
                reader.onload = function (e) {
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
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            input.files = dataTransfer.files;
        }
    </script>
</x-app-layout>
