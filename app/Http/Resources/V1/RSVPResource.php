<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RSVPResource extends JsonResource
{
    public static $wrap = 'rsvps';
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
                'event_id' => $this->event_id,
                'alumni_id' => $this->alumni_id,
                'alumni_name' => $this->getAlumniName(),
                'event_title' => $this->getEventTitle(),
                'relationship_loaded' => $this->isRelationshipLoaded(),
                'created_at'  => $this->created_at->toDateTimeString(),
                'updated_at'  => $this->updated_at->toDateTimeString(),
            ],
            'relationships' =>[
                'event' => [
                    'id' => $this->event->id ?? null,
                    'name' => $this->event->name ?? null,
                ],
                'alumni' => [
                    'id' => $this->alumni->id ?? null,
                    'name' => $this->alumni->name ?? null,
                ],
            ],
            'links' => [
                'self' => route('rSVP.show', $this->id)
            ]
        ];
    }
}
