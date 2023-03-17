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
            'phone' => $this->phone,
            'description' => $this->description,
            'link' => $this->link,
            'address' => AddressResource::collection($this->addresses),
            'image' => url('storage/' . $this->image),
            'banners' => AffiliateBannerResource::collection($this->bannersImages),
            'city' => (new CityResource($this->city)),
            'loadings' => $this->loadings(),
            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),
            'instructors' => UserResource::collection($this->whenLoaded('instructors')),
        ];
    }
}
