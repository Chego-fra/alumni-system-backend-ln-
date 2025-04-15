<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    public static $wrap = 'events';
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
                'date'        => $this->date,
                'time'        => $this->time,
                'location'    => $this->location,
                'description' => $this->description,
                'organizer'   => $this->organizer,
                'attendees'   => $this->attendees,
                'image'       => $this->image,
                'created_at'  => $this->created_at->toDateTimeString(),
                'updated_at'  => $this->updated_at->toDateTimeString(),
                'is_upcoming' => $this->isUpcoming(),
                'is_past' => $this->isPast(), 
                'rsvp_count' => $this->getRsvpCount(), 
                'event_schedule' => $this->getEventSchedule(), 
                'summary' => $this->getSummary(),
            ],
            'relationships' =>[
                'rsvps' => $this->rsvps->pluck('id'), 
            ],
            'links' => [
                'self' => route('events.show', $this->id)
            ]
        ];
    }
}
