<?php

namespace App\Data\Traits;

use Illuminate\Support\Str;

/**
 * SlugifyTrait
 *
 * Used to auto generate slug for a model
 */
trait SlugifyTrait
{
    public static function handleObserver()
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
