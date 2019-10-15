<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Products extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     * @var string
     */
    public $collects = 'App\Http\Resources\Product';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'data' => $this->collection,
        ];
    }

    /*public function with($request){
        return [
            'meta' => [
                'key' => 'value',
            ],
        ];
    }*/
}
