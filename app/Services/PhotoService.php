<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PhotoService
{
    public function upload(UploadedFile $file, string $folder = 'uploads'): array
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $destination = public_path($folder);
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return [
            'url' => url($folder . '/' . $filename),
            'filename' => $filename,
        ];
    }

    public function delete(string $filename, string $folder = 'uploads'): bool
    {
        $filePath = public_path($folder . '/' . $filename);

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }
}
