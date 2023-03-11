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
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'name' => $this->name,
            'phone' => $this->phone,
            'description' => $this->description,
            'photo' => (new FileResource($this->photo)),

            'favorite_affiliate_id' => $this->favorite_affiliate_id,
            'assignments' => AssignmentResource::collection($this->whenLoaded('assignments')),

            'works_in_affiliate' => (new AffiliateResource($this->whenLoaded('worksInAffiliate'))),
            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),

            'fb_token' => $this->fb_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
