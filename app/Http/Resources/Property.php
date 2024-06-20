<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Property extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslatedAttribute('title'),
            'slug' => $this->slug,
            'values' => array_map(fn ($item) => $item['title'], PropertyValue::collection($this->values)->resolve())
        ];
    }
}
