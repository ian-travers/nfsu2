<?php

namespace App\Models;

use Illuminate\Support\Str;

trait HasUniqueSlug
{
    protected static function boot()
    {
        parent::boot();

        static::created(fn($model) => $model->update(['slug' => Str::slug($model->title) . '-' . Str::padLeft($model->id, 8, '0')]));
    }
}
