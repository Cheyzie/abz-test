<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;

class PhotoService {
    public static function save(UploadedFile $photo, $storage = 'local', $path = 'public/photos/'): string {
        $filename = static::generateFileName($photo->getClientOriginalExtension());
        $image = Image::make($photo);
        $image->crop(300, 300);
        Storage::disk($storage)
            ->put($path.$filename, $image->encode(quality: 80));
        return $path.$filename;
    }

    public static function generateFileName($extension):string {
        return Uuid::uuid4().'.'.$extension;
    }
}
