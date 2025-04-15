<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelHelpers\ResourceModelHelper;
use App\Traits\Relationships\ResourceRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resources extends Model
{
    use HasFactory;
    use  ResourceModelHelper;
    use ResourceRelationships;
    const TABLE = 'resources';
    protected $table = self::TABLE;

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

    protected $casts = [
        'title' => 'string' ,
        'category'  => 'string' ,
        'description'  => 'string' ,
        'file_url'  => 'string' ,
        'video_url'  => 'string' ,
        'posted_by' => 'integer',   
        'date_posted' => 'date', 
        'image' => 'string',
    ];
}
