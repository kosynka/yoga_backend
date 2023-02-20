<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AffiliateResource extends JsonResource
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
            'description' => $this->whenNotNull($this->description),
            'address' => $this->address,
            'image' => (new FileResource($this->whenLoaded('image'))),
            'city' => (new CityResource($this->whenLoaded('city'))),
            'master' => (new UserResource($this->whenLoaded('master'))),
        ];
    }
}
