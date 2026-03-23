<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait StoresUniqueUploads
{
    protected function storeUniquePublicFile(UploadedFile $file, string $directory): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'bin');
        $filename = now()->format('YmdHis') . '_' . Str::lower(Str::random(24)) . '.' . $extension;

        return $file->storeAs($directory, $filename, 'public');
    }
}

