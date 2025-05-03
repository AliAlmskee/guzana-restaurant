<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    public function toArray($request)
    {
        $showAll = $request->attributes->get('show_all_languages', false);
        
        return [
            'content' => $showAll ? $this->translations : $this->getLocalizedContent($request),
        ];
    }

    protected function getLocalizedContent($request)
    {
        $lang = $request->attributes->get('validated_lang', 'de');
        return $this->translations[$lang] ?? $this->translations['de'] ?? '';
    }

}