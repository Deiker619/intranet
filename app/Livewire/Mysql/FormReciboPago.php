<?php

namespace App\Livewire\Mysql;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\sigespServices;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FormReciboPago extends Component
{
    public $show;
    protected $sigespServices;
    public $periodo;
    public $rules = [
        'periodo' => 'required|string|min:1'
    ];
    public $meses = [
        '1' => 'Enero',
        '2' => 'Febrero',
        '3' => 'Marzo',
        '4' => 'Abril',
        '5' => 'Mayo',
        '6' => 'Junio',
        '7' => 'Julio',
        '8' => 'Agosto',
        '9' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function extract_mes_español($mes)
    {
        
        return $this->meses[$mes];
    }


    public function boot(sigespServices $sigespServices)
    {
        $this->sigespServices = $sigespServices;
    }

    public function render()
    {
        $periodos = $this->sigespServices->getPeriodos();
        $periodos = $this->ordenarPeriodos($periodos);
        //dd($periodos);
        //dd($periodos[1]->periodo);
        return view('livewire.mysql.form-recibo-pago', compact('periodos'));
    }

    public function dataSigesp()
    {

        $this->validate();
        $recibo_pago = $this->sigespServices->getReciboPago(Auth::user()->cedper, $this->periodo);
        $this->reset(['periodo']);
        //dd($recibo_pago);
        if ($this->validateStatusReciboPago($recibo_pago)) {
            $this->dispatch('post-created', recibo_pago: $recibo_pago);
        };
    }
    public function validateStatusReciboPago($recibo_pago)
    {
        $statusCode = $recibo_pago->getStatusCode();

        if ($statusCode == 200) {
            $this->dispatch('showAlertSuccess', 'Registro encontrado');
            return true; //Esta apto para emitir recibo de pago
        } 
        if ($statusCode == 423){
            $this->dispatch('showAlertError', 'Registro no encontrado');
            return false;
        } 
    }

    public function ordenarPeriodos($periodos)
    {
        $periodosOrdenados = $periodos->toArray();
        usort($periodosOrdenados, function ($a, $b) {
            // Convertir el periodo a una fecha para comparar
            $dateA = DateTime::createFromFormat('n-Y', $a->periodo);
            $dateB = DateTime::createFromFormat('n-Y', $b->periodo);

            // Comparar las fechas
            return $dateA <=> $dateB;
        });
        return $periodosOrdenados;
    }

    
}
