<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniProfileResource extends JsonResource
{
    public static $wrap = 'alumniprofiles';
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
               'name'  => $this->name,
               'image' => $this->image,
               'graduation_year' => $this->graduation_year,
               'major' => $this->major,
               'company' => $this->company,
               'location' => $this->location,
               'created_at' => $this->created_at->toDateTimeString(),
               'updated_at' => $this->updated_at->toDateTimeString(),
               'profile_summary' => $this->getProfileSummary(),
               'social_links' => $this->fullSocialLinks(),
               'has_company' => $this->hasCompany(),
            ],
            'relationships' =>[
                'careers' => $this->careers->pluck('id', 'name'), 
                'career_replies' => $this->careerReplies->pluck('id'),
                'rsvps' => $this->rsvps->pluck('id'),
            ],
            'links' => [
                'self' => route('alumniProfile.show', $this->id)
            ]
        ];
    }
}
