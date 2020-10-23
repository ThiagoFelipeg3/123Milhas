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
        $this->grupos ['groups'] = [];
    }

    public function voosAgrupados()
    {
        $voos = $this->milhas->getFlights();
        $this->grupos['flights'] = $voos;

        $tarifaAgrupada = collect($voos)->mapToGroups(function ($item) {
            return [$item['fare'] => $item];
        });

        foreach($tarifaAgrupada as $tarifa) {
            $this->agruparPrecos($tarifa->toArray());
        }

       return $this->criarGrupos();
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

    private function criarGrupos(): array
    {
        foreach($this->inbound as $keyIn => $in) {
            foreach($this->outbound as $keyOut => $out){
                if ($keyIn == $keyOut) {
                    $this->destinos($in, $out);
                    break;
                }
            }
        }

        $this->informacoesExtras();
        $this->grupos['groups'] = $this->ordenarPorPreco()->values();
        return $this->grupos;
    }

    private function informacoesExtras()
    {
        $menorPreco = $this->ordenarPorPreco()->first();
        $this->grupos['totalGroups'] = count($this->grupos['groups']);
        $this->grupos['totalFlights'] = $this->totalVoosUnicos();
        $this->grupos['cheapestPrice'] = $menorPreco['totalPrice'];
        $this->grupos['cheapestGroup'] = $menorPreco['uniqueId'];
    }

    private function ordenarPorPreco()
    {
        return collect($this->grupos['groups'])->sortBy('totalPrice');
    }

    private function totalVoosUnicos()
    {
        return collect($this->grupos['groups'])->filter(function($value) {
            return count($value['outbound']) == 1 && count($value['inbound']) == 1;
        })->count();
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

    private function somarValor($in, $out)
    {
        $inOut = array_merge($in, $out);
        return array_reduce($inOut, function ($acumulador, $item) {
            $acumulador += $item['price'];
            return $acumulador;
        });
    }
}
