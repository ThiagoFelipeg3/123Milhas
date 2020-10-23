<?php

namespace App\Services;

use App\Services\AgruparVoos;
use App\Services\Milhas123;

class VoosServices
{
    private $agruparVoos;
    private $milhas123;

    public function __construct(
        AgruparVoos $agruparVoos,
        Milhas123 $milhas123
    ) {
        $this->agruparVoos = $agruparVoos;
        $this->milhas123 = $milhas123;
    }

    public function getVoos()
    {
        return $this->agruparVoos->voosAgrupados();
    }

    public function getVoosOutbound()
    {
        return collect($this->milhas123->getFlights())
        ->filter(function ($voo) {
            return $voo['outbound'];
        });
    }

    public function getVoosInbound()
    {
        return collect($this->milhas123->getFlights())
        ->filter(function ($voo) {
            return $voo['inbound'];
        });
    }
}