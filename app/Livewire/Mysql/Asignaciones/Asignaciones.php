<?php

namespace App\Livewire\Mysql\Asignaciones;

use Livewire\Component;
use App\Services\calculation_services;

class Asignaciones extends Component
{
    public $data;
    protected $calculation_services;

    public function mount($data)
    {
        $this->data = $data;
    }

    public function boot(calculation_services $calculation_services){
        $this->calculation_services = $calculation_services;
    }

    public function render()
    {
        return view('livewire.mysql.asignaciones.asignaciones');
    }

    public function totalAsignaciones(){ 
        $totalAsignaciones = $this->calculation_services->totalAsignaciones($this->data);
        return $totalAsignaciones;
    }
}
