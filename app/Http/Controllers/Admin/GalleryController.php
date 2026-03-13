<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::orderBy('order')->paginate(20);
        return view('admin.gallery.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
            'alt' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        GalleryItem::create([
            'image' => $path,
            'caption' => $request->caption,
            'alt' => $request->alt,
            'is_active' => $request->boolean('is_active'),
            'order' => $request->input('order', 0),
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Imagen agregada exitosamente.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.edit', ['galleryItem' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'caption' => 'nullable|string|max:255',
            'alt' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $data = [
            'caption' => $request->caption,
            'alt' => $request->alt,
            'is_active' => $request->boolean('is_active'),
            'order' => $request->input('order', 0),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Imagen actualizada exitosamente.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Imagen eliminada exitosamente.');
    }
}
