<?php
namespace App\Traits\Relationships;

use App\Models\AlumniProfile;
use App\Models\CareerReplies;



trait CareerRelationships
{
    public function postedBy()
    {
        return $this->belongsTo(AlumniProfile::class, 'posted_by');
    }

    public function careerReplies()
    {
        return $this->hasMany(CareerReplies::class, 'career_id');
    }
}