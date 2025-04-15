<?php
namespace App\Traits\Relationships;

use App\Models\RSVP;

trait EventRelationships
{
    public function rsvps()
    {
        return $this->hasMany(RSVP::class, 'event_id');
    }
}