<?php
namespace App\Traits\Relationships;

use App\Models\AlumniProfile;

trait ResourceRelationships
{
    public function postedBy()
    {
        return $this->belongsTo(AlumniProfile::class, 'posted_by');
    }
}