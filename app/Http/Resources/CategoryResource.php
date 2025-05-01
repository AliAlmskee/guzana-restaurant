<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $showAll = $request->attributes->get('show_all_languages', false);
        
        return [
            'id' => $this->id,
            'name' => $showAll ? $this->name : $this->getLocalizedName($request),
            'dishes' => $this->whenLoaded('dishes', function() use ($request, $showAll) {
                return DishResource::collection($this->dishes)
                    ->additional(['show_all_languages' => $showAll]);
            })
        ];
    }

    protected function getLocalizedName($request)
    {
        $lang = $request->attributes->get('validated_lang', 'de');
        return $this->name[$lang] ?? $this->name['de'] ?? '';
    }
}