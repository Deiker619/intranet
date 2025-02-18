<?php

namespace App\Livewire\Mysql;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\sigespServices;

class FormReciboPago extends Component
{
    public $show;
    protected $sigespServices;
    public $fechasper;
    public $fechadesper;

    public function boot(sigespServices $sigespServices)
    {
        $this->sigespServices = $sigespServices;
    }

    public function render()
    {
        $periodos = $this->sigespServices->periodos();

        return view('livewire.mysql.form-recibo-pago', compact('periodos'));
    }
    public function setPeriodo($date)
    {
        $this->fechadesper = $date;
        if (!$date) return $this->fechasper = '';
        $this->fechasper = $this->sigespServices->periodos_por_fecdesper($date);
        $this->fechasper = $this->fechasper[0]->fechasper;
    }

    public function dataSigesp()
    {
        $recibo_pago = $this->sigespServices->recibo_pago_sigesp($this->fechadesper, $this->fechasper);
        $this->dispatch('post-created', recibo_pago: $recibo_pago);
    }
}
