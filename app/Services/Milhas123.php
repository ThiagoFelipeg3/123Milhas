<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class Milhas123
{
    private $url;

    public function __construct()
    {
        $this->url = config('integracao.123_milhas.url');
    }

    public function getFlights(): array
    {
        $url = sprintf(
            "%s/api/flights",
            $this->url
        );

        return Http::get($url)->json();
    }
}