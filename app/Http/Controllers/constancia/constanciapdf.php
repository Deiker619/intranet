<?php

namespace App\Http\Controllers\constancia;

use App\Http\Controllers\Controller;
use App\Services\sigespServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;



class constanciapdf extends Controller
{
    protected $sigespService;
    public function __construct(sigespServices $sigesp_services)
    {
        $this->sigespService = $sigesp_services;
    }
    public function get_datos()
    {
        $datos = $this->sigespService->getConstanciaTrabajo(Auth::user()->cedper);
        $statusCode = $datos->getStatusCode();

        /* FIXME: Emitir sesion flask */
        if($statusCode != 200){
            return 0;
        }
        //dd($datos);
        $datos = json_decode(json_encode($datos->original['data']['data'])?? []);
        return $this->generate_constancia($datos);
    }
    public function generate_constancia($datos)
    {
        $data = [
            'datos_trabajador' => $datos
        ];
     
        $pdf = Pdf::loadView('livewire.constancia.pdf.invoice', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true);
        return $pdf->stream();
    }
}
