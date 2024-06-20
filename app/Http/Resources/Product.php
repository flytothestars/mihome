<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cat = null;
        if ($this->category) {
            if ($this->category->parent) {
                $cat = $this->category->ancestors()->orderBy('_lft', 'asc')->first();
            } else {
                $this->category;
            }
        }
        $arr = parent::toArray($request);
        $arr['in_stock']  = $this->in_stock;
        $arr['kaspi']  = $this->kaspi;
        $arr['tag']  = $cat ? [
            'slug' => $cat->slug,
            'name' => $cat->name,
        ] : null;
        $arr['old_price_formatted']  = $this->old_price_formatted;
        $arr['price_formatted']  = $this->price_formatted;

        return $arr;
    }
}
