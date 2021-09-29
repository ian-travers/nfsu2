<?php

namespace App\Models\Downloads;

class NfsuSavePatcher extends DownloadFile
{
    public function __construct()
    {
        $this->path = '/downloads/nfsu-save-patcher';
        $this->href = '/storage/files/nfsu-save-patcher.zip';
        $this->size = 167704;
        $this->link_en = 'NFSU Save Patcher';
        $this->link_ru= 'NFSU Редактор сохранений';
        $this->title_en = 'NFSU Save Patcher';
        $this->title_ru = 'NFSU Редактор Сохранений';
    }
}
