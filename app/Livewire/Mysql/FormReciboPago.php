<?php

namespace App\Livewire\Mysql;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\sigespServices;
use Illuminate\Support\Facades\Auth;

class FormReciboPago extends Component
{
    public $show;
    protected $sigespServices;
    public $periodo;
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

    public function extract_mes_español($mes){
        return $this->meses[$mes];
    }
    

    public function boot(sigespServices $sigespServices)
    {
        $this->sigespServices = $sigespServices;
    }

    public function render()
    {
        $periodos = $this->sigespServices->getPeriodos();

        return view('livewire.mysql.form-recibo-pago', compact('periodos'));
    }
    public function setPeriodo($date)
    {
        $this->periodo = $date;
    }

    public function dataSigesp()
    {
        $recibo_pago = $this->sigespServices->getReciboPago(Auth::user()->cedper, $this->periodo);

        //dd($recibo_pago->original['data'], $recibo_pago);
        $this->dispatch('post-created', recibo_pago: $recibo_pago);
    }
}
