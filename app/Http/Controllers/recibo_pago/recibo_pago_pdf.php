<?php

namespace App\Http\Controllers\recibo_pago;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\sigespServices;
use App\Services\calculation_services;
use Barryvdh\DomPDF\Facade\Pdf;


class recibo_pago_pdf extends Controller
{
    protected $sigespServices;
    protected $calculation_services;

    public function __construct(sigespServices $sigespServices, calculation_services $calculation_services)
    {
        $this->sigespServices = $sigespServices;
        $this->calculation_services = $calculation_services;
    }
    public function generate_recibo_pago()
    {
        $data = session('recibo_pago');
        $recibo_pago = [
            'recibo_pago' => $data
        ];

        //dd($recibo_pago);
        $pdf = Pdf::loadView('livewire.mysql.pdf.recibo_pago_pdf', $recibo_pago)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true);

        session()->forget('recibo_data');

        return $pdf->stream();
    }
}
