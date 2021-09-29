<?php

namespace App\Models\Downloads;

class Nfsu extends DownloadFile
{
    public function __construct()
    {
        $this->path = '/downloads/nfsu';
        $this->href = '/storage/files/nfsu.zip';
        $this->size = 967743249;
        $this->link_en = 'NFSU Underground';
        $this->link_ru= 'NFSU Underground';
        $this->title_en = 'NFS Underground';
        $this->title_ru = 'NFS Underground';
    }
}
