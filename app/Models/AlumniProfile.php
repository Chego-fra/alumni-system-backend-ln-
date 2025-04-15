<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelHelpers\AlumniModelHelper;
use App\Traits\Relationships\AlumniRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlumniProfile extends Model
{
    use HasFactory;
    use  AlumniRelationships;
    use AlumniModelHelper;
    const TABLE = 'alumni_profiles';
    protected $table = self::TABLE;

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

    protected $casts = [
        'graduation_year' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'major' => 'string',
        'company' => 'string',
        'location' => 'string',
        'linkedin' => 'string',
        'twitter' => 'string',
    ];
    

}
