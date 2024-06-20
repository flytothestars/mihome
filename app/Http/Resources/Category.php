<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Meilisearch\Endpoints\Indexes;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->getTranslatedAttribute('name'),
            'description' => $this->getTranslatedAttribute('description'),
            'meta_title' => $this->getTranslatedAttribute('meta_title'),
            'meta_desc' => $this->getTranslatedAttribute('meta_desc'),
            'url' => $this->url,
            'webp' => $this->webp,
            'filters' => $this->filters,
            'min' => $this->min,
            'max' => $this->max,
            'children' => self::collection($this->children)->resolve()
        ];
    }
}
