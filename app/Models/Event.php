<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'time',
        'location',
        'description',
        'organizer',
        'attendees',
        'image',
    ];

    public function rsvps()
    {
        return $this->hasMany(RSVP::class, 'event_id');
    }
}
