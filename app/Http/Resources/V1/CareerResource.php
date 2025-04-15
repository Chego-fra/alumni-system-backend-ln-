<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
{
    public static $wrap = 'career';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' =>  'career',
            'id' => $this->id,
            'attributes' => [
               'title'  => $this->title,
               'company' => $this->company,
               'location' => $this->location,
               'description' => $this->description,
               'requirements' => $this->requirements,
               'posted_by' => $this->posted_by,
               'image' => $this->image,
               'date_posted' => $this->date_posted->toDateTimeString(),
               'created_at' => $this->created_at->toDateTimeString(),
               'updated_at' => $this->updated_at->toDateTimeString(),
               'posted_by_name' => $this->getPostedByName(),
               'job_summary' => $this->getJobSummary(),
               'formatted_date_posted' => $this->getFormattedDatePosted(),
               'total_replies' => $this->getTotalReplies(),
               'is_recent' => $this->isRecentlyPosted(),
               'has_image' => $this->hasImage(),
            ],
            'relationships' => [
                'postedBy' => [
                    'id' => $this->postedBy->id ?? null,
                    'name' => $this->postedBy->name ?? null,
                ],
                'career_replies' => $this->careerReplies->map(function ($reply) {
                    return [
                        'id' => $reply->id,
                        'name' => $reply->name ?? null, // Assuming each reply has a "name" field
                    ];
                }),
            ],

            'links' => [
                'self' => route('career.show', $this->id)
            ]
        ];
    }
}
