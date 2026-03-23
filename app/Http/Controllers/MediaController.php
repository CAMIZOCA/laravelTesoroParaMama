<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function show(string $path): Response
    {
        $normalized = ltrim($path, '/');

        if (str_contains($normalized, '..')) {
            abort(404);
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($normalized)) {
            abort(404);
        }

        return response()->file($disk->path($normalized));
    }
}

