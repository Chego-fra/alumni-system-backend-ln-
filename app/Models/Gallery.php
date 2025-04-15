<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelHelpers\GalleryModelHelper;
use App\Traits\Relationships\GalleryRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    use GalleryModelHelper;
     use GalleryRelationships;
    const TABLE = 'galleries';
    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'type',
        'file_path',
        'description',
        'posted_by',
    ];  

    protected $casts = [
        'title' => 'string' ,
        'type' => 'string',
        'file_path' => 'string',
        'description' => 'string',
        'posted_by' => 'integer',
    ];
}
