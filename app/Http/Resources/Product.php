<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved
     * @var bool
     */
    //public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'type' => 'products',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'price' => $this->price
            ],
            'links' => [
                'self' => 'http://blog.test/api/products/'.$this->id
            ]
        ];
    }
}
