<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyReviewsResource extends JsonResource
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
            'industry' => new IndustryResource($this->industry),
            'manager' => new UserResource($this->manager),
            'employees' => $this->employees,
            'description' => $this->description,
            'revenue' => $this->revenue,
            'city' => $this->city,
            'country_code' => $this->country_code,
            'address' => $this->address,
            'mission' => $this->mission,
            'stars' => $this->getStars($this->reviews),
            'reviews_count' => $this->reviews->count(),
            'reviews'=> ReviewResource::collection($this->reviews),
        ];
    }
    protected function getStars($reviews)
    {
        $stars = 0;
        foreach ($reviews as $review) {
            $stars += $review->stars;
        }
        if($reviews->count() == 0) {
            return 0;
        }
        return $stars/$reviews->count();
    }
}