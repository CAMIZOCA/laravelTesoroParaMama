<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StoresUniqueUploads
{
    protected function storeUniquePublicFile(UploadedFile $file, string $directory): string
    {
        [$data, $ext] = $this->prepareUploadData($file);
        $filename = now()->format('YmdHis') . '_' . Str::lower(Str::random(24)) . '.' . $ext;
        $path = $directory . '/' . $filename;
        Storage::disk('public')->put($path, $data);
        return $path;
    }

    private function prepareUploadData(UploadedFile $file): array
    {
        if (!function_exists('imagewebp')) {
            $ext = strtolower($file->getClientOriginalExtension() ?: 'bin');
            return [file_get_contents($file->getRealPath()), $ext];
        }

        $mime = $file->getMimeType();
        $realPath = $file->getRealPath();

        $image = match (true) {
            str_contains($mime, 'jpeg') || str_contains($mime, 'jpg') => @imagecreatefromjpeg($realPath),
            str_contains($mime, 'png')  => @imagecreatefrompng($realPath),
            str_contains($mime, 'webp') => @imagecreatefromwebp($realPath),
            str_contains($mime, 'gif')  => @imagecreatefromgif($realPath),
            default => null,
        };

        if (!$image) {
            $ext = strtolower($file->getClientOriginalExtension() ?: 'bin');
            return [file_get_contents($realPath), $ext];
        }

        // Preserve PNG transparency in the WebP output
        if (str_contains($mime, 'png')) {
            imagepalettetotruecolor($image);
            imagealphablending($image, false);
            imagesavealpha($image, true);
        }

        ob_start();
        imagewebp($image, null, 85);
        $webpData = ob_get_clean();
        imagedestroy($image);

        if (!$webpData) {
            $ext = strtolower($file->getClientOriginalExtension() ?: 'bin');
            return [file_get_contents($realPath), $ext];
        }

        return [$webpData, 'webp'];
    }
}
