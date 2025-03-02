<?php

namespace App\Models;

use App\Traits\EnumCastAppendAttributeTrait;
use App\Traits\FileUploadTrait;
use App\Traits\LogsTrait;
use App\Traits\ModelDateTextTrait;
use App\Traits\MorphModelTriggerTrait;
use App\Traits\PaginatableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use PaginatableTrait,EnumCastAppendAttributeTrait,
        SoftDeletes,ModelDateTextTrait,MorphModelTriggerTrait;
    use LogsTrait;
}
