<?php

namespace App\Livewire\Mysql;

use App\Services\sigespServices;
use Livewire\Component;
use Livewire\Attributes\On; 

class Modal extends Component
{
    public $show = false;
    protected $sigespServices;
    public $data = [];

    public function boot(sigespServices $sigespServices)
    {
        $this->sigespServices = $sigespServices;

    }

    public function prueba(){
       dd( $this->sigespServices->get_conceptos_personal());
    }
    public function render()
    {
        return view('livewire.mysql.modal');
    }

    #[On('post-created')] 
    public function showModal($recibo_pago){
        $this->data = json_decode(json_encode($recibo_pago[0] ?? []));
        /* dd($this->data); */
        $this->show = true;

    }
    
}
