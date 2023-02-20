<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'type' => (new TypeResource($this->whenLoaded('type'))),
            'instructor_id' => $this->whenNotNull($this->instructor_id),
            // 'instructor' => (new UserResource($this->whenLoaded('instructor'))),
            'starts_at' => $this->starts_at,
            'comment' => $this->whenNotNull($this->comment),
        ];
    }
}
