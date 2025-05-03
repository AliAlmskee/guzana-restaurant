<?php
namespace App\Http\Controllers;

use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function about(Request $request)
    {
        return $this->getContent($request, 'ABOUT');
    }

    public function menu(Request $request) 
    {
        return $this->getContent($request, 'MENU');
    }

    private function getContent(Request $request, string $type)
    {
        $lang = $request->attributes->get('validated_lang', 'de');
        $content = Content::where('key', $type)->firstOrFail();
        
        return new ContentResource($content);
    }

    // Admin method to update content
    public function updateContent(Request $request, string $type)
    {
        $validated = $request->validate([
            'translations' => 'required|array',
            'translations.*' => 'string'
        ]);

        Content::updateOrCreate(
            ['key' => $type],
            ['translations' => $validated['translations']]
        );

        return response()->json(['message' => 'Content updated']);
    }
}