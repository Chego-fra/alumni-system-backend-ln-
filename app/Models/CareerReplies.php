<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelHelpers\CareerRepliesModelHelper;
use App\Traits\Relationships\CareerReplyRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CareerReplies extends Model
{
    use HasFactory;
    use CareerRepliesModelHelper;
    use CareerReplyRelationships;
    const TABLE = 'career_replies';
    protected $table = self::TABLE;

    protected $fillable = [
        'career_id',
        'alumni_id',
        'message',
    ];  

    protected $casts = [
        'career_id' => 'integer',
        'alumni_id' => 'integer',
        'message' => 'string',
    ];
}
