<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Support\StoresUniqueUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use StoresUniqueUploads;

    public function index(): View
    {
        $testimonials = Testimonial::orderBy('order')->orderByDesc('created_at')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'         => 'required|string|max:100',
            'product_name' => 'nullable|string|max:150',
            'text'         => 'required|string|max:1000',
            'image'        => 'nullable|image|max:3072',
            'is_visible'   => 'boolean',
            'order'        => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUniquePublicFile($request->file('image'), 'testimonials');
        }

        $data['is_visible'] = $request->boolean('is_visible', true);
        $data['order']      = (int) $request->input('order', 0);

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonio añadido correctamente.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validate([
            'name'         => 'required|string|max:100',
            'product_name' => 'nullable|string|max:150',
            'text'         => 'required|string|max:1000',
            'image'        => 'nullable|image|max:3072',
            'is_visible'   => 'boolean',
            'order'        => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUniquePublicFile($request->file('image'), 'testimonials');
        } else {
            unset($data['image']);
        }

        $data['is_visible'] = $request->boolean('is_visible');
        $data['order']      = (int) $request->input('order', 0);

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonio actualizado correctamente.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonio eliminado.');
    }
}
