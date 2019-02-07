<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            
            'name'=>$this->name,
            
            'description'=>$this->detail,

            'price'=>$this->price,

            'stock'=>$this->stock == 0 ? 'Out of Stock' : $this->stock,

            'totalPrice'=>$this->discount==0 ?  $this->price : $this->price - (($this->discount/100) * ($this->price )),

            'discount'=>$this->discount,

            'rating' => $this->reviews->count() > 0 ? $this->reviews->sum('start')/$this->reviews->count(): 'No Rating yet',

            'href'=>[
                'reviews'=>route('review.index', $this->id)
            ]

        ];
    }
}
