<?php

namespace App\Livewire\Mysql;

use App\Services\sigespServices;
use App\Services\calculation_services;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\Attributes\On;

class Modal extends Component
{
    public $show = false;
    protected $sigespServices;
    protected $calculation_services;
    public $data = [];

    public function boot(sigespServices $sigespServices, calculation_services $calculation_services)
    {
        $this->sigespServices = $sigespServices;
        $this->calculation_services = $calculation_services;
    }

    public function prueba()
    {
        dd($this->sigespServices->getReciboPago());
    }
    public function render()
    {
        return view('livewire.mysql.modal');
    }

    #[On('post-created')]
    public function showModal($recibo_pago)
    {
        $this->data = [
            'primera-quincena' => json_decode(json_encode($recibo_pago['original']['data']['primera-quincena'] ?? $recibo_pago['original']['data']['priPeriodo'] ?? [])),
            'segunda-quincena' => json_decode(json_encode($recibo_pago['original']['data']['segunda-quincena'] ?? $recibo_pago['original']['data']['segPeriodo'] ?? []))
        ];
        // dd($this->data);
        $totales = $this->calculateTotales();
        $this->data = $totales;
        $this->show = true;
    }
    public function calculateTotales()
    {
        $totales = $this->calculation_services->calculateTotales($this->data);
        return $totales;
    }
    public function export_recibo_pago(){
        session(['recibo_pago' => $this->data]);
        redirect()->route('generate_recibo_pago');
    }
}
