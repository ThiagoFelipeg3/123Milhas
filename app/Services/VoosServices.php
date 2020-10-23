<?php

namespace App\Services;

class VoosServices
{
    private $agruparVoos;

    public function __construct(AgruparVoos $agruparVoos)
    {
        $this->agruparVoos = $agruparVoos;
    }

    public function getVoos()
    {
        return $this->agruparVoos->voosAgrupados();
    }
}