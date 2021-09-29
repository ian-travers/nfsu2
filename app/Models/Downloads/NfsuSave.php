<?php

namespace App\Models\Downloads;

class NfsuSave extends DownloadFile
{
    public function __construct()
    {
        $this->path = '/downloads/nfsu-save';
        $this->href = '/storage/files/nfsu-save.zip';
        $this->size = 9309;
        $this->link_en = 'NFSU Save';
        $this->link_ru= 'NFSU Сохранение';
        $this->title_en = 'NFSU Save Files';
        $this->title_ru = 'NFSU Сохранение';
    }
}
