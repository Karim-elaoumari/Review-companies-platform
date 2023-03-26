<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'website' => $this->website,
            'logo' => $this->logo,
            'founded' => $this->founded,
            'industry' => $this->industry,
            'manager' => $this->manager,
            'employees' => $this->employees,
            'revenue' => $this->revenue,
            'city' => $this->city,
            'address' => $this->address,
            'mission' => $this->mission,
        ];
    }
}
