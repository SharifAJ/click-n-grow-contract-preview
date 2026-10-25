<x-app-layout>
    <x-header-title :title="__('Blog Posts')" />

    <div class="mt-5 rounded-sm border border-stroke bg-white p-6 shadow-default">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <p class="text-gray-600">Manage published articles, thumbnails, and blog page links.</p>
            <a class="btn btn-primary" href="{{ route('admin.blogs.create') }}">Create Blog Post</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        @if ($posts->isEmpty())
            <p class="py-8 text-center text-gray-600">No blog posts yet. Create a post to publish it on the website.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Published</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <img class="h-14 w-20 rounded object-cover"
                                        src="{{ asset('storage/' . $post->thumbnail_path) }}" alt="">
                                </td>
                                <td class="font-semibold">{{ $post->title }}</td>
                                <td>
                                    <span class="badge {{ $post->is_published ? 'badge-success' : 'badge-ghost' }}">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>{{ $post->published_at?->format('M j, Y') ?? '—' }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a class="btn btn-sm btn-outline"
                                            href="{{ route('admin.blogs.edit', $post) }}">Edit</a>
                                        @if ($post->is_published)
                                            <a class="btn btn-sm btn-outline" target="_blank" rel="noopener"
                                                href="{{ route('blogs.show', $post->slug) }}">View</a>
                                        @endif
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $post) }}"
                                            onsubmit="return confirm('Delete this blog post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-error btn-outline" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">{{ $posts->links() }}</div>
        @endif
    </div>
</x-app-layout>
