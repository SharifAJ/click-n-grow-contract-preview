<x-app-layout>
    <x-header-title :title="$post->exists ? __('Edit Blog Post') : __('Create Blog Post')" />

    <div class="mt-5 rounded-sm border border-stroke bg-white p-6 shadow-default">
        <form method="POST"
            action="{{ $post->exists ? route('admin.blogs.update', $post) : route('admin.blogs.store') }}"
            enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($post->exists)
                @method('PUT')
            @endif

            <div class="form-control">
                <label class="label" for="title"><span class="label-text font-semibold">Title</span></label>
                <input class="input input-bordered w-full" id="title" name="title" maxlength="180"
                    value="{{ old('title', $post->title) }}" required>
                @error('title')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="form-control">
                <label class="label" for="excerpt"><span class="label-text font-semibold">Summary</span></label>
                <textarea class="textarea textarea-bordered w-full" id="excerpt" name="excerpt" rows="3"
                    maxlength="500" placeholder="A short description shown on the blog cards">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="form-control">
                <label class="label" for="content"><span class="label-text font-semibold">Article</span></label>
                <textarea class="textarea textarea-bordered w-full" id="content" name="content" rows="16"
                    required>{{ old('content', $post->content) }}</textarea>
                <span class="mt-1 text-sm text-gray-500">Plain text is supported; paragraphs are preserved.</span>
                @error('content')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            @if ($post->exists)
                <div>
                    <p class="mb-2 font-semibold">Current thumbnail</p>
                    <img class="h-40 max-w-full rounded object-cover"
                        src="{{ asset('storage/' . $post->thumbnail_path) }}" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="form-control">
                <label class="label" for="thumbnail">
                    <span class="label-text font-semibold">Thumbnail {{ $post->exists ? '(optional)' : '' }}</span>
                </label>
                <input class="file-input file-input-bordered w-full" id="thumbnail" name="thumbnail" type="file"
                    accept=".jpg,.jpeg,.png,.webp" {{ $post->exists ? '' : 'required' }}>
                <span class="mt-1 text-sm text-gray-500">JPG, PNG, or WebP; maximum file size 4 MB.</span>
                @error('thumbnail')<span class="mt-1 text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <label class="flex items-center gap-3">
                <input type="hidden" name="is_published" value="0">
                <input class="checkbox checkbox-success" type="checkbox" name="is_published" value="1"
                    @checked(old('is_published', $post->is_published))>
                <span class="font-semibold">Publish this post</span>
            </label>

            <div class="flex justify-end gap-3">
                <a class="btn btn-neutral" href="{{ route('admin.blogs.index') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">{{ $post->exists ? 'Save Changes' : 'Create Post' }}</button>
            </div>
        </form>
    </div>
</x-app-layout>
