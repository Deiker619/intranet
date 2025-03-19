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
        $salario = $datos['salario'] ?? 0; // Aqui se asegura el salario y la letra 
        $datos['salario_letras'] = $this->convertirNumeroALetras($salario);

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

        // Descargar el PDF
        return $pdf->stream();
    }

    /**
     * Convierte un número a letras.
     *
     * @param float $number El número a convertir.
     * @return string El número en letras.
     */
    private function convertirNumeroALetras($number)
    {
        // Crear una instancia de NumberToWords
        $numberToWords = new NumberToWords();

        // Obtener el transformador de números a palabras en español
        $numberTransformer = $numberToWords->getNumberTransformer('es');

        // Convertir el número a letras
        return $numberTransformer->toWords($number);
    }
}