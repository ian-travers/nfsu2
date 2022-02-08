<?php

namespace App\Models;

trait NativeAttribute
{
    public function getNativeAttributeValue(string $attribute)
    {
        $locale = empty(app()->getLocale())
            ? 'en'
            : app()->getLocale();

        return $this->{$attribute . '_' . $locale};
    }
}
