<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()->latest()->paginate(20);

        return view('dashboard.blogs.index', compact('posts'));
    }

    public function create(): View
    {
        return view('dashboard.blogs.form', ['post' => new BlogPost()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('blogs', 'public');
        if ($thumbnailPath === false) {
            throw new RuntimeException('Unable to store the blog thumbnail.');
        }

        $isPublished = $request->boolean('is_published');
        BlogPost::create([
            'title' => $validated['title'],
            'slug' => $this->uniqueSlug($validated['title']),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'thumbnail_path' => $thumbnailPath,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? now() : null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog): View
    {
        return view('dashboard.blogs.form', ['post' => $blog]);
    }

    public function update(Request $request, BlogPost $blog): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $isPublished = $request->boolean('is_published');
        $thumbnailPath = $blog->thumbnail_path;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blogs', 'public');
            if ($thumbnailPath === false) {
                throw new RuntimeException('Unable to store the blog thumbnail.');
            }
        }

        $oldThumbnailPath = $blog->thumbnail_path;
        $blog->update([
            'title' => $validated['title'],
            'slug' => $this->uniqueSlug($validated['title'], $blog->id),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'thumbnail_path' => $thumbnailPath,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? ($blog->published_at ?? now()) : null,
        ]);

        if ($thumbnailPath !== $oldThumbnailPath) {
            Storage::disk('public')->delete($oldThumbnailPath);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        $thumbnailPath = $blog->thumbnail_path;
        $blog->delete();
        Storage::disk('public')->delete($thumbnailPath);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        if ($baseSlug === '') {
            $baseSlug = 'blog-post';
        }

        $slug = $baseSlug;
        $suffix = 2;

        while (BlogPost::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }
}
