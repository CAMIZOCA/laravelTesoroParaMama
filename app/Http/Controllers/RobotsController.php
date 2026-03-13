<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function index(): Response
    {
        $content = SeoSetting::get('robots_txt', implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin/',
            'Disallow: /login',
            '',
            'Sitemap: ' . url('/sitemap.xml'),
        ]));

        return response($content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
