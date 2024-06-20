<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->getTranslatedAttribute('title'),
            'url' => $this->url,
            'introtext' => $this->getTranslatedAttribute('introtext'),
            'fulltext' => $this->getTranslatedAttribute('fulltext'),
            'metakey' => $this->getTranslatedAttribute('metakey'),
            'metadesc' => $this->getTranslatedAttribute('metadesc'),
            'webp' => $this->webp
        ];
    }
}
