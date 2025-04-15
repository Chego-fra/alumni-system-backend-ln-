<?php
namespace App\Traits\Relationships;

use App\Models\AlumniProfile;

trait GalleryRelationships
{
    public function postedBy()
    {
        return $this->belongsTo(AlumniProfile::class, 'posted_by');
    }
}