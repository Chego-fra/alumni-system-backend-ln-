<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerRepliesResource extends JsonResource
{
    public static $wrap = 'career_replies';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'career_replies',
            'id' => $this->id,
            'attributes' => [
                'career_id' => $this->career_id,
                'alumni_id' => $this->alumni_id,
                'message' => $this->message
            ],
            'relationships' => [
                'career' => [
                    'id' => $this->career->id ?? null,
                    'title' => $this->career->title ?? null,
                ],
                'alumni' => [
                    'id' => $this->alumni->id ?? null,
                    'name' => $this->alumni->name ?? null,
                ],
            ],
            'links' => [
                'self' => route('careerReplies.show', $this->id),
            ],
        ];
    }
}
