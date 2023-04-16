<?php

namespace App\Http\Resources;

use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewCompaniesResource extends JsonResource
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
            'content' => $this->content,
            'stars' => $this->stars,
            'status' => $this->status,
            'reviewer' => $this->reviewer,
            'company' => new CompanyResource($this->company),
        ];
    }
}
