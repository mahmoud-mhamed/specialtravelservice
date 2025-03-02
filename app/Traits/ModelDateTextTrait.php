<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string created_at_text
 * @property-read string updated_at_text
 * @property-read string deleted_at_text
 */
trait ModelDateTextTrait
{
    protected static function bootModelDateTextTrait(): void
    {
        static::retrieved(static fn(Model $model) => self::handelAttrModelDateTextTrait($model, 'retrieved'));
        static::saving(static fn(Model $model) => self::handelAttrModelDateTextTrait($model, 'saving'));
    }

    private static function handelAttrModelDateTextTrait(Model $model, string $type): void
    {
        foreach (['created_at', 'updated_at'] as $translate) {
            if ($type === 'retrieved') {
                $model->setAttribute($translate . '_text', (new self)->getDate(data_get($model->getAttributes(),$translate)));
            } else {
                unset($model->{$translate . '_text'});
            }
        }
    }


    public function getDeletedAtTextAttribute(): ?string
    {
        return $this->getDate($this->deleted_at);
    }

    private function getDate($date): ?string
    {
        if (!$date) {
            return '---';
        }
        $carbon = !is_string($date) && get_class($date) == Carbon::class ? $date : Carbon::parse($date);
        if ($carbon->diffInHours() < 24) {
            return self::translateDate($carbon->diffForHumans());
        }

        if ($carbon->diffInDays() < 7) {
            return self::translateDate($carbon->format('Y-m-d h:i A'));
        }

        return self::translateDate($carbon->format('Y-m-d'));
    }
    public static function translateDate($formatedDataTime): string
    {
        $locale = app()->getLocale();
        $replacements = [
            'ar' => ['AM' => 'ص', 'PM' => 'م'],
            'en' => ['AM' => 'AM', 'PM' => 'PM'],
        ];

        $replacement = $replacements[$locale] ?? $replacements['en'];

        return str_replace(array_keys($replacement), array_values($replacement), $formatedDataTime);
    }

}
