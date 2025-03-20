<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'alumni_id',
        'message',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function alumni()
    {
        return $this->belongsTo(AlumniProfile::class, 'alumni_id');
    }
}
