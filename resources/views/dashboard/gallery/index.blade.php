<x-app-layout>
    <x-header-title :title="__('Image Gallery')" />

    <div class="mt-5 rounded-sm border border-stroke bg-white p-6 shadow-default">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <p class="text-gray-600">Edit image captions and titles, upload photos, or hide items from the public gallery.</p>
            <a class="btn btn-primary" href="{{ route('admin.gallery.create') }}">Add Image</a>
        </div>

        @if (session('success'))<div class="alert alert-success mb-4">{{ session('success') }}</div>@endif

        @if ($items->isEmpty())
            <p class="py-8 text-center text-gray-600">No gallery images yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table">
                    <thead><tr><th>Image</th><th>Title</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td><img class="h-14 w-20 rounded object-cover" src="{{ $item->image_url }}" alt=""></td>
                                <td class="font-semibold">{{ $item->title }}</td>
                                <td>{{ $item->sort_order }}</td>
                                <td><span class="badge {{ $item->is_published ? 'badge-success' : 'badge-ghost' }}">{{ $item->is_published ? 'Published' : 'Hidden' }}</span></td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline" href="{{ route('admin.gallery.edit', $item) }}">Edit</a>
                                        <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Delete this gallery image?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-error btn-outline" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">{{ $items->links() }}</div>
        @endif
    </div>
</x-app-layout>
