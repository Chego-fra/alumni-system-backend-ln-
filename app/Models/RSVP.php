<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelHelpers\RSVPModelHelper;
use App\Traits\Relationships\RSVPRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RSVP extends Model
{
    use HasFactory;
    use RSVPModelHelper;
    use RSVPRelationships;
    const TABLE = 'r_s_v_p_s';
    protected $table = self::TABLE;

    protected $fillable = [
        'event_id',
        'alumni_id',
    ];  

    protected $casts = [
        'event_id'  => 'integer',
        'alumni_id'  => 'integer',  
    ];
}
