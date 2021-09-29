<?php

namespace App\Models\Downloads;

use App\Models\NativeAttribute;

abstract class DownloadFile
{
    use NativeAttribute;

    public string $path;
    public string $href;
    public string $link_en;
    public string $link_ru;
    public string $title_en;
    public string $title_ru;
    public int $size;

    public function link()
    {
        return $this->getNativeAttributeValue('link');
    }

    public function title()
    {
        return $this->getNativeAttributeValue('title');
    }
}
