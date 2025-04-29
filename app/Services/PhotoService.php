<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
class PhotoService
{
    public function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($folder), $filename);

        return $filename; 
    }

    public function delete(string $filename): bool
    {
        $path = 'uploads/' . $filename;
        
        if (!file_exists(public_path($path))) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Photo not found');
        }
            return unlink($path);
    }

    public function getPhotoByName(string $filename)
    {
        $path = 'uploads/' . $filename;
        
        if (!file_exists(public_path($path))) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Photo not found');
        }
    
        return response()->file(public_path($path));
    }
}
