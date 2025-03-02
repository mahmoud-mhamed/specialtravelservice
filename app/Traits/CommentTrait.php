<?php

namespace App\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property-read Comment[] comments
*/
trait CommentTrait
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class,'model')->with('createdBy')->orderBy('id','asc');
    }
}
