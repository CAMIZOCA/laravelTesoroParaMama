<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class MediaController extends Controller
{
    public function show(string $path): RedirectResponse
    {
        $normalized = ltrim($path, '/');

        if (str_contains($normalized, '..')) {
            abort(404);
        }

        // Shared hosting can restrict PHP file access outside public_html.
        // Redirect to the publicly exposed storage path handled by the web server.
        return redirect()->to(asset('storage/' . $normalized));
    }
}
