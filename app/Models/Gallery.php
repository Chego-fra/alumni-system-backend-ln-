<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'url',
        'description',
        'posted_by',
    ];

    public function postedBy()
    {
        return $this->belongsTo(AlumniProfile::class, 'posted_by');
    }
}
