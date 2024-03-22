<?php

namespace App\Models;

class Data
{
    private $nieruchomosc;
    private $miesiac;
    private $prad;
    private $gaz;
    private $woda;

    public function __construct($nieruchomosc, $miesiac, $prad, $gaz, $woda)
    {
        $this->nieruchomosc = $nieruchomosc;
        $this->miesiac = $miesiac;
        $this->prad = $prad;
        $this->gaz = $gaz;
        $this->woda = $woda;
    }

 
}