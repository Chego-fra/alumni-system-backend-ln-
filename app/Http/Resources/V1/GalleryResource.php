<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public static $wrap = 'gallery';
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
                'title'       => $this->title,
                'short_title' => $this->getShortTitle(),
                'type'       => $this->type,
                'type_icon' => $this->getTypeIcon(),
                'file_path'       => $this->file_path,
                'full_url' => $this->getFullMediaUrl(),
                'description'       => $this->description,
                'description_preview' => $this->getDescriptionPreview(),
                'posted_by'       => $this->posted_by,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' =>[
                // 'postedBy' => $this->postedBy->pluck('id','name'), 
                'postedBy' => [
                    'id' => $this->postedBy->id ?? null,
                    'name' => $this->postedBy->name ?? null,
                ],
            ],
            'links' => [
                'self' => route('gallery.show', $this->id)
            ]
        ];
    }
}
