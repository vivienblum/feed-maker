<?php

namespace App\Services;

use App;
use App\User;
use Storage;
use Illuminate\Http\UploadedFile;

class Uploader
{
    public function upload(UploadedFile $file, User $user, string $name = null): string
    {
        $fileName = $name ?? time().$file->getClientOriginalName();
        $env = App::environment();
        $filePath = "{$env}/images/{$user->id}/{$fileName}";
        Storage::disk('s3')->put($filePath, file_get_contents($file));

        return Storage::disk('s3')->url($filePath);
    }
}
