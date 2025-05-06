<?php

namespace App\Http\Controllers\constancia;

use App\Http\Controllers\Controller;
use App\Services\sigespServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use NumberToWords\NumberToWords; // Paquete de numeros a letras

class constanciapdf extends Controller
{
    protected $sigespService;

    public function __construct(sigespServices $sigesp_services)
    {
        $this->sigespService = $sigesp_services;
    }

    public function get_datos()
    {
        // Obtener los datos del trabajador
        $datos = $this->sigespService->getConstanciaTrabajo(Auth::user()->cedper);
        $statusCode = $datos->getStatusCode();
        // Manejar errores
        if ($statusCode != 200) {
            return 0;
        }
        // Decodificar los datos
        $datos = json_decode(json_encode($datos->original['data']['data']), true);
        // Convertir el salario a letras
        $datos['sueldo_integral'] = $this->salarioIntegralMensual($datos['sueldo_integral']);
        $salario = $datos['sueldo_integral'] * 100 ?? 0; // Aqui se asegura el salario y la letra 
        $datos['salario_letras'] = strtoupper($this->convertirNumeroALetras($salario));
        //dd($datos);
        // Generar el PDF
        return $this->generate_constancia($datos);
    }

    public function generate_constancia($datos)
    {
        // Datos para la vista
        $data = [
            'datos_trabajador' => $datos
        ];
        // Generar el PDF
        $pdf = Pdf::loadView('livewire.constancia.pdf.invoice', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true);

        // Configurar headers para abrir en nueva pestaña
        return $pdf->download('constancia.pdf')
            ->header('Content-Disposition', 'inline; filename="constancia.pdf"');
    }
    /**
     * Convierte un número a letras.
     *
     * @param float $number El número a convertir.
     * @return string El número en letras.
     */
    private function convertirNumeroALetras($number)
    {
        return NumberToWords::transformCurrency('es', round($number), 'VEB'); // outputs "fifty dollars ninety nine cents"
    }

    public function salarioIntegralMensual($salarioIntegral){
        $salarioIntegral = $salarioIntegral * 2;
        return $salarioIntegral;

    }
}