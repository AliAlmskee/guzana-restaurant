<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class DishResource extends JsonResource
{
    public function toArray($request)
    {
        $showAll = $request->attributes->get('show_all_languages', false);
        
        $base = [
            'id' => $this->id,
            'photo' => $this->photo,
            'category_id' => $this->category_id,
        ];

        if ($showAll) {
            $base['name'] = $this->name;
            $base['description'] = $this->description;
        } else {
            $lang = $request->attributes->get('validated_lang', 'de');
            $base['name'] = $this->name[$lang] ?? $this->name['de'] ?? '';
            $base['description'] = $this->description[$lang] ?? $this->description['de'] ?? '';
        }

        return $base;
    }
}