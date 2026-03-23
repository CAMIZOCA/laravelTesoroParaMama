<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageContentController extends Controller
{
    public function index(): View
    {
        $defaults = PageContent::defaults();
        $saved    = PageContent::all_settings();
        $content  = array_merge($defaults, $saved);

        return view('admin.content.index', compact('content'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'historia_image'   => 'nullable|image|max:3072',
            'tangible_image'   => 'nullable|image|max:3072',
            'instr_step1_image' => 'nullable|image|max:3072',
            'instr_step2_image' => 'nullable|image|max:3072',
        ]);

        $data = $request->except(['_token', '_method', 'historia_image', 'tangible_image', 'instr_step1_image', 'instr_step2_image']);

        // Handle image uploads
        foreach (['historia_image', 'tangible_image', 'instr_step1_image', 'instr_step2_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('content', 'public');
            }
        }

        PageContent::saveMany($data);

        return redirect()->route('admin.content.index')
            ->with('success', 'Contenido actualizado exitosamente.');
    }
}
