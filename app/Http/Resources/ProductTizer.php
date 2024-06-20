<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class ProductTizer extends JsonResource
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
        $arr = [];
        $arr['in_stock']  = $this->in_stock;
        $arr['rating']  = $this->rating;
        $arr['ratingcount']  = $this->ratingcount;
        $arr['url']  = $this->url;
        $arr['name']  = $this->name;
        $arr['description']  = $this->description;
        $arr['id']  = $this->id;
        $arr['url']  = $this->url;
        $arr['url']  = $this->url;
        $arr['kaspi']  = $this->kaspi;
        $arr['price']  = $this->price;
        $arr['old_price']  = $this->old_price;
        $arr['image'] = $this->images()->count() ? Voyager::image($this->images[0]->link) : '/no-photo.png';
        $arr['tag']  = $cat ? [
            'slug' => $cat->slug,
            'name' => $cat->name,
        ] : null;
        $arr['old_price_formatted']  = $this->old_price_formatted;
        $arr['price_formatted']  = $this->price_formatted;

        return $arr;
    }
}
