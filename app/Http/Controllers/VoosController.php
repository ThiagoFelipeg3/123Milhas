<?php

namespace App\Http\Controllers;

use App\Services\VoosServices;
use Illuminate\Http\Request;
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
}
