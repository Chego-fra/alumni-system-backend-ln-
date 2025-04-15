<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelHelpers\EventModelHelper;
use App\Traits\Relationships\EventRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;
    use EventModelHelper;
    use EventRelationships;
    const TABLE = 'events';
    protected $table = self::TABLE;

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

    protected $casts = [
        'title' => 'string',
        'date' => 'date',
        'time' => 'string',
        'location' => 'string',
        'description' => 'string',
        'organizer' => 'string',
        'attendees' => 'integer',
        'image' => 'string',
    ];
}
