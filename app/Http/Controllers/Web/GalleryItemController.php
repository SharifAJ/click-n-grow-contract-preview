<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::query()->orderBy('sort_order')->orderByDesc('id')->paginate(20);
        return view('dashboard.gallery.index', compact('items'));
    }

    public function create(): View
    {
        return view('dashboard.gallery.form', ['item' => new GalleryItem()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'caption' => ['nullable', 'string', 'max:500'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $path = $request->file('image')->store('gallery', 'public');
        if ($path === false) {
            throw new RuntimeException('Unable to store the gallery image.');
        }

        GalleryItem::create([
            'title' => $validated['title'],
            'caption' => $validated['caption'] ?? null,
            'image_path' => $path,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created successfully.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('dashboard.gallery.form', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'caption' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $oldPath = $gallery->image_path;
        $newPath = $oldPath;
        if ($request->hasFile('image')) {
            $newPath = $request->file('image')->store('gallery', 'public');
            if ($newPath === false) {
                throw new RuntimeException('Unable to store the gallery image.');
            }
        }

        $gallery->update([
            'title' => $validated['title'],
            'caption' => $validated['caption'] ?? null,
            'image_path' => $newPath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_published' => $request->boolean('is_published'),
        ]);

        if ($newPath !== $oldPath && !str_starts_with($oldPath, 'images/')) {
            Storage::disk('public')->delete($oldPath);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $path = $gallery->image_path;
        $gallery->delete();
        if (!str_starts_with($path, 'images/')) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}
