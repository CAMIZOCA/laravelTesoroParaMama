<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoController extends Controller
{
    public function index(): View
    {
        $defaults = SeoSetting::defaults();
        $saved    = SeoSetting::all()->pluck('value', 'key')->toArray();
        $seo      = array_merge($defaults, $saved);

        return view('admin.seo.index', compact('seo'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name'             => 'required|string|max:100',
            'meta_title'            => 'required|string|max:70',
            'meta_description'      => 'required|string|max:160',
            'meta_keywords'         => 'nullable|string|max:255',
            'og_title'              => 'nullable|string|max:95',
            'og_description'        => 'nullable|string|max:200',
            'og_image'              => 'nullable|image|max:2048',
            'og_type'               => 'nullable|string|max:50',
            'twitter_card'          => 'nullable|string|in:summary,summary_large_image,app,player',
            'twitter_site'          => 'nullable|string|max:50',
            'twitter_creator'       => 'nullable|string|max:50',
            'google_analytics_id'   => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'facebook_pixel_id'     => 'nullable|string|max:50',
            'canonical_url'         => 'nullable|url|max:255',
            'robots_txt'            => 'nullable|string|max:2000',
            'schema_phone'          => 'nullable|string|max:50',
            'schema_email'          => 'nullable|email|max:100',
            'schema_address'        => 'nullable|string|max:255',
        ]);

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('seo', 'public');
            $validated['og_image'] = route('media.show', ['path' => ltrim($path, '/')]);
        } else {
            unset($validated['og_image']); // keep existing if no new file
        }

        SeoSetting::saveMany($validated);

        return redirect()->route('admin.seo.index')
            ->with('success', 'Configuración SEO guardada exitosamente.');
    }
}
