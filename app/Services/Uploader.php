<?php

namespace App\Services;

use Storage;
use Illuminate\Http\UploadedFile;

class Uploader
{
    public function upload(UploadedFile $file, string $name = null)
    {
        $fileName = $name ?? time().$file->getClientOriginalName();
        $filePath = "images/{$fileName}";
        Storage::disk('s3')->put($filePath, file_get_contents($file));

        return Storage::disk('s3')->url($filePath);
    }
}
