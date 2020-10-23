<?php

namespace App\Services;

use App\Service\Milhas123;

class AgruparVoos
{
    private $milhas;
    private $grupos;
    private $inbound;
    private $outbound;

    public function __construct(Milhas123 $milhas)
    {
        $this->milhas = $milhas;
        $this->grupos = [];
    }

    public function agruparVoos()
    {
        $voos = $this->milhas->getFlights();

        $tarifaAgrupada = collect($voos)->mapToGroups(function ($item) {
            return [$item['fare'] => $item];
        });

        foreach($tarifaAgrupada as $tarifa) {
            $this->agruparPrecos($tarifa->toArray());
        }

        $this->criarGrupos();
        return $this->grupos;
    }

    private function agruparPrecos(array $voos)
    {
        $precoAgrupado = collect($voos)->mapToGroups(function ($item) {
            return [$item['price'] => $item];
        });

        foreach ($precoAgrupado as $key => $preco) {
            $this->separarDestinos($key, $preco->toArray());
        }
    }

    private function separarDestinos($key, array $voos)
    {
        foreach($voos as $voo) {
            if ($voo['outbound'] == 1) {
               $this->outbound[$voo['fare']][$key][] = $voo;
                continue;
            }
            $this->inbound[$voo['fare']][$key][] = $voo;
        }
    }

    private function criarGrupos()
    {
        foreach($this->inbound as $keyIn => $in) {
            foreach($this->outbound as $keyOut => $out){
                if ($keyIn == $keyOut) {
                    $this->destinos($in, $out);
                    break;
                }
            }
        }
    }

    private function destinos($inbound, $outbound)
    {
        foreach($inbound as $in) {
            foreach($outbound as $out) {
                $this->grupos['groups'][] = [
                    'uniqueId' => count($this->grupos['groups']),
                    'totalPrice' => $this->somarValor($in, $out),
                    'outbound' => $out,
                    'inbound' => $in
                ];
            }
        }
    }

    public function somarValor($in, $out)
    {
        $inOut = array_merge($in, $out);
        return array_reduce($inOut, function ($acumulador, $item) {
            $acumulador += $item['price'];
            return $acumulador;
        });
    }
}
