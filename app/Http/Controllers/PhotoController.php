<?php

namespace App\Http\Controllers;

use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PhotoController extends Controller
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function upload(Request $request): JsonResponse
    {
        $request->validate(rules: [
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
        ]);

        $path = $this->photoService->upload($request->file('photo'));

        return response()->json([
            'message' => 'Photo uploaded successfully',
            'path' => $path,
        ]);
    }

    public function delete($filename): JsonResponse
    {

        $deleted = $this->photoService->delete($filename);

        if ($deleted) {
            return response()->json(['message' => 'Photo deleted successfully']);
        }

        return response()->json(['message' => 'Photo not found or already deleted'], 404);
    }

    public function showByName($filename)
    {
        return $this->photoService->getPhotoByName($filename);
    }
}
