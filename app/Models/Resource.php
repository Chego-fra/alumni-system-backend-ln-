<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'file_url',
        'video_url',
        'posted_by',
        'date_posted',
        'image',
    ];

    public function postedBy()
    {
        return $this->belongsTo(AlumniProfile::class, 'posted_by');
    }
}
