<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Support\StoresUniqueUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageContentController extends Controller
{
    use StoresUniqueUploads;

    public function index(): View
    {
        $defaults = PageContent::defaults();
        $saved    = PageContent::all_settings();
        $content  = array_merge($defaults, $saved);

        return view('admin.content.index', compact('content'));
    }

    public function update(Request $request): RedirectResponse
    {
        $imageFields = [
            'hero_image', 'historia_image',
            'tangible_image', 'tangible_image_2', 'tangible_image_3',
            'personaliz_image', 'personaliz_image_2', 'personaliz_image_3',
            'instr_step1_image', 'instr_step2_image',
            'proceso_image_1', 'proceso_image_2', 'proceso_image_3',
            'kit_image_1', 'kit_image_2', 'kit_image_3',
            'testimonios_image_1', 'testimonios_image_2', 'testimonios_image_3',
            'faq_image_1', 'faq_image_2', 'faq_image_3',
        ];

        $request->validate(
            array_fill_keys($imageFields, 'nullable|image|max:3072')
        );

        $data = $request->except(array_merge(['_token', '_method'], $imageFields));

        // Handle image uploads
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $this->storeUniquePublicFile($request->file($field), 'content');
            }
        }

        PageContent::saveMany($data);

        return redirect()->route('admin.content.index')
            ->with('success', 'Contenido actualizado exitosamente.');
    }
}
