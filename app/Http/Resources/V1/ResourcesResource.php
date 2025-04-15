<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourcesResource extends JsonResource
{
    public static $wrap = 'resources';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' =>  'alumniprofile',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'category' => $this->category,
                'category_tag' => $this->getCategoryTag(),
                'description' => $this->description,
                'short_description' => $this->getShortDescription(),
                'file_url' => $this->file_url,
                'has_file' => $this->hasFile(),
                'video_url' => $this->video_url,
                'has_video' => $this->hasVideo(),
                'posted_by' => $this->posted_by,
                'date_posted' => $this->getFormattedDate(),
                'image' => $this->image,
                'image_url' => $this->getImageUrl(),
                'created_at'  => $this->created_at->toDateTimeString(),
                'updated_at'  => $this->updated_at->toDateTimeString(),
            ],
            'relationships' =>[
                'postedBy' => [
                    'id' => $this->postedBy->id ?? null,
                    'name' => $this->postedBy->name ?? null,
                ],
            ],
            'links' => [
                'self' => route('resources.show', $this->id)
            ]
        ];
    }
}
