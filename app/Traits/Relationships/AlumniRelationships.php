<?php

namespace App\Traits\Relationships;

use App\Models\RSVP;
use App\Models\Career;
use App\Models\CareerReplies;


trait AlumniRelationships
{
    public function careers()
    {
        return $this->hasMany(Career::class, 'posted_by');
    }

    public function careerReplies()
    {
        return $this->hasMany(CareerReplies::class, 'alumni_id');
    }

    public function rsvps()
    {
        return $this->hasMany(RSVP::class, 'alumni_id');
    }
}
