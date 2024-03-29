<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Benchmark;

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
            'type' => (new TypeResource($this->type)),
            'instructor' => new UserResource($this->whenLoaded('instructor')),
            'starts_at' => $this->starts_at,
            'continuance' => $this->continuance,
            'participants_limitation' => $this->participants_limitation,
            'assignments_amount' => $this->assignmentsAmount(),
            'comment' => $this->comment,
            'assignments' => AssignmentResource::collection($this->whenLoaded('assignments')),
            // 'affiliate' => (new AffiliateResource($this->affiliate)),
        ];
    }
}
