<?php

namespace App\Http\Controllers\constancia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class constanciapdf extends Controller
{
    //
    public function generate_constancia()
    {
        $pdf = Pdf::loadView('livewire.constancia.pdf.invoice')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true);
        return $pdf->stream();
    }
}
