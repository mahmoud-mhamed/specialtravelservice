<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use temp\temp\FileCast;

/**
 * used to append file url attribute
 * @author mahmoud-mhamed <mahmoud1272022@gmail.com>
 */
trait FileCastAppendAttributeTrait
{
    protected static function bootFileCastAppendAttributeTrait(): void
    {
        static::retrieved(static fn(Model $model) => self::handelFileCastAttr($model, 'retrieved'));
        static::saving(static fn(Model $model) => self::handelFileCastAttr($model, 'saving'));
    }

    private static function handelFileCastAttr(Model $model, string $type): void
    {
        foreach ($model->getCasts() as $column_name => $cast_type) {
            if ($cast_type == FileCast::class) {
                if ($type === 'retrieved') {
                    $model->setAttribute($column_name . '_url', @$model->{$column_name}->full_url);
                } else {
                    unset($model->{$column_name . '_url'});
                }
            }
        }
    }
}
