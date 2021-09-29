<?php

namespace App\Models\Downloads;

class NfsuClient extends DownloadFile
{
    public function __construct()
    {
        $this->path = '/downloads/nfsu-client';
        $this->href = '/storage/files/nfsu-client.zip';
        $this->size = 45753;
        $this->link_en = 'NFSU Client';
        $this->link_ru= 'NFSU клиент';
        $this->title_en = 'NFS Underground client';
        $this->title_ru = 'NFS Underground клиент';
    }
}
