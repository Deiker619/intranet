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
    public function generate_constancia($id)
    {
        $data = [
            'datos_trabajador' => Auth::user()
        ];
        $pdf = Pdf::loadView('livewire.constancia.pdf.invoice', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true);
        return $pdf->stream();
    }
}
