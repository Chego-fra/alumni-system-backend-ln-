<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'graduation_year',
        'major',
        'company',
        'location',
        'linkedin',
        'twitter',
    ];

    public function careers()
    {
        return $this->hasMany(Career::class, 'posted_by');
    }

    public function careerReplies()
    {
        return $this->hasMany(CareerReply::class, 'alumni_id');
    }

    public function rsvps()
    {
        return $this->hasMany(RSVP::class, 'alumni_id');
    }
}
