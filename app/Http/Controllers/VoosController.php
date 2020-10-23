<?php

namespace App\Http\Controllers;

use App\Services\VoosServices;
use Symfony\Component\HttpFoundation\Response;

class VoosController extends Controller
{
    private $voosServices;

    public function __construct(VoosServices $voosServices)
    {
        $this->voosServices = $voosServices;
    }

    public function voos()
    {
        return response($this->voosServices->getVoos(), Response::HTTP_OK);
    }

    public function voosOutbound()
    {
        return response($this->voosServices->getVoosOutbound(), Response::HTTP_OK);
    }

    public function voosInbound()
    {
        return response($this->voosServices->getVoosInbound(), Response::HTTP_OK);
    }
}
