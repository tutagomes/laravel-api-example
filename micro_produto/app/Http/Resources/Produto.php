<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Produto extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'updated_at' => $this->updated_at,
            'price' => $this->price,
            'inventory' => $this->inventory,
            'discounted_price' => $this->when($this->discount != 0 , $this->price - $this->price * ($this->discount/100)),
            'discount' => $this->discount
        ];
    }
}
