<x-app-layout>
    <x-header-title :title="$item->exists ? __('Edit Gallery Image') : __('Add Gallery Image')" />

    <div class="mt-5 rounded-sm border border-stroke bg-white p-6 shadow-default">
        <form method="POST" action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($item->exists) @method('PUT') @endif

            <div class="form-control">
                <label class="label" for="title"><span class="label-text font-semibold">Image title</span></label>
                <input class="input input-bordered w-full" id="title" name="title" maxlength="180" value="{{ old('title', $item->title) }}" required>
                @error('title')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="form-control">
                <label class="label" for="caption"><span class="label-text font-semibold">Caption</span></label>
                <textarea class="textarea textarea-bordered w-full" id="caption" name="caption" rows="3" maxlength="500">{{ old('caption', $item->caption) }}</textarea>
                @error('caption')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            @if ($item->exists)
                <div><p class="mb-2 font-semibold">Current image</p><img class="h-48 max-w-full rounded object-cover" src="{{ $item->image_url }}" alt="{{ $item->title }}"></div>
            @endif

            <div class="form-control">
                <label class="label" for="image"><span class="label-text font-semibold">Image {{ $item->exists ? '(optional)' : '' }}</span></label>
                <input class="file-input file-input-bordered w-full" id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" {{ $item->exists ? '' : 'required' }}>
                <span class="mt-1 text-sm text-gray-500">JPG, PNG, or WebP; maximum file size 8 MB.</span>
                @error('image')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="form-control max-w-xs">
                <label class="label" for="sort_order"><span class="label-text font-semibold">Display order</span></label>
                <input class="input input-bordered" id="sort_order" name="sort_order" type="number" min="0" max="9999" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                @error('sort_order')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <label class="flex items-center gap-3">
                <input type="hidden" name="is_published" value="0">
                <input class="checkbox checkbox-success" type="checkbox" name="is_published" value="1" @checked(old('is_published', $item->exists ? $item->is_published : true))>
                <span class="font-semibold">Show in public gallery</span>
            </label>

            <div class="flex justify-end gap-3">
                <a class="btn btn-neutral" href="{{ route('admin.gallery.index') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">{{ $item->exists ? 'Save Changes' : 'Add Image' }}</button>
            </div>
        </form>
    </div>
</x-app-layout>
