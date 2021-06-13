<?php

namespace App\Models;

trait NativeAttribute
{
    public function getNativeAttributeValue(string $attribute)
    {
        return $this->{$attribute . '_' . app()->getLocale()};
    }
}
