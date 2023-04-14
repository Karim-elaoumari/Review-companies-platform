<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'photo'      => 'http://localhost:8000/images/'.$this->photo,
            'email'      => $this->email,
            'speciality' =>$this->speciality,
            'job'        => $this->job->name,
            'job_id'     => $this->job_id,
         ];
    }
}
