<?php

namespace App\Http\Resources;

use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $collects = CountryResource::class;

    public function toArray($request)
    {
        return [
            'countries' => $this->collection,
        ];
    } 
}
