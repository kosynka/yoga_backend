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
            'photo' => (new FileResource($this->whenLoaded('photo'))),

            'favorite_affiliate' => (new AffiliateResource($this->whenLoaded('favoriteAffiliate'))),    // for users
            'assignments' => AssignmentResource::collection($this->whenLoaded('assignments')),          // for users

            'works_in_affiliate' => (new AffiliateResource($this->whenLoaded('worksInAffiliate'))),     // for instructors
            'lessons' => (new LessonResource($this->whenLoaded('lessons'))),                            // for instructors

            'fb_token' => $this->whenNotNull($this->fb_token),
            'phone_verified_at' => $this->phone_verified_at,
            'created_at' => $this->whenNotNull($this->created_at),
            'updated_at' => $this->whenNotNull($this->updated_at),
        ];
    }
}
