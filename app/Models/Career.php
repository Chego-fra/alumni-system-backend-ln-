<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'description',
        'requirements',
        'posted_by',
        'image',
        'date_posted',
    ];

    public function postedBy()
    {
        return $this->belongsTo(AlumniProfile::class, 'posted_by');
    }

    public function careerReplies()
    {
        return $this->hasMany(CareerReply::class, 'career_id');
    }
}
