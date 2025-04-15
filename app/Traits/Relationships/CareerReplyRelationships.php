<?php
namespace App\Traits\Relationships;

use App\Models\Career;
use App\Models\AlumniProfile;


trait CareerReplyRelationships
{
    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function alumni()
    {
        return $this->belongsTo(AlumniProfile::class, 'alumni_id');
    }
}