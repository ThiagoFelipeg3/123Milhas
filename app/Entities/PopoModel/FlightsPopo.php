<?php

namespace App\Entities\PopoModel;

use App\Entities\PopoModel\PopoModel;

class FlightsPopo extends PopoModel
{
    public $id; //Identificador único do voo
    public $cia; //Companhia aérea responsável pelo voo
    public $fare; //Tipo de tarifa (Fator determinante no agrupamento)
    public $flightNumber; //Número do voo
    public $departureDate; //Data de saída do voo
    public $arrivalDate; //Data de chegada do voo
    public $origin; //Identificador do aeroporto de saída
    public $destination; //Identificador do aeroporto de chegada
    public $departureTime; //Horário de saída
    public $arrivalTime; //Horário de chegada
    public $price; //Preço do voo (Fator determinante no agrupamento)
    public $duration; //Tempo de duração do voo
    public $outbound; //Determina se o voo é ida
    public $inbound; //Determina se o voo é volta

    public function fromArray(array $dados)
    {
        $this->id = $dados['id'];
        $this->cia = $dados['cia'];
        $this->fare = $dados['fare'];
        $this->flightNumber = $dados['flightNumber'];
        $this->departureDate = $dados['departureDate'];
        $this->arrivalDate = $dados['arrivalDate'];
        $this->origin = $dados['origin'];
        $this->destination = $dados['destination'];
        $this->departureTime = $dados['departureTime'];
        $this->arrivalTime = $dados['arrivalTime'];
        $this->price = $dados['price'];
        $this->duration = $dados['duration'];
        $this->outbound = $dados['outbound'];
        $this->inbound = $dados['inbound'];
    }
}