<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelHelpers\CareerModelHelper;
use App\Traits\Relationships\CareerRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use HasFactory;
    use  CareerRelationships;
    use CareerModelHelper;
    const TABLE = 'careers';
    protected $table = self::TABLE;

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

    protected $casts = [
        'title' => 'string',
        'company' => 'string',
        'location' => 'string',
        'description' => 'string',
        'requirements' => 'string',
        'posted_by' => 'integer',
        'image' => 'string',
        'date_posted' => 'date',
    ];
}
