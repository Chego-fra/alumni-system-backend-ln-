<?php
namespace App\Traits\Relationships;

use App\Models\Events;
use App\Models\AlumniProfile;

trait RSVPRelationships
{
    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function alumni()
    {
        return $this->belongsTo(AlumniProfile::class, 'alumni_id');
    }
}