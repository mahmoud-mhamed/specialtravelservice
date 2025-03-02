<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

trait UseTranslationsTrait
{
    use HasTranslations;

    protected static function bootUseTranslationsTrait(): void
    {
        static::retrieved(static fn(Model $model) => self::handelAttrUseTranslationsTrait($model, 'retrieved'));
        static::saving(static fn(Model $model) => self::handelAttrUseTranslationsTrait($model, 'saving'));
    }

    private static function handelAttrUseTranslationsTrait(Model $model, string $type): void
    {
        foreach ($model->translatable as $translate) {
            if ($type === 'retrieved') {
                $model->setAttribute($translate . '_text', $model->{$translate});
            } else {
                unset($model->{$translate . '_text'});
            }
        }
    }
}
