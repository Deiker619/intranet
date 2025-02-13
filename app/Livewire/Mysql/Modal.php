<?php

namespace App\Livewire\Mysql;

use Livewire\Component;
use Livewire\Attributes\On; 

class Modal extends Component
{
    public $show = false; 
    public $data = [];
    
    public function render()
    {
        return view('livewire.mysql.modal');
    }

    #[On('post-created')] 
    public function showModal($recibo_pago){
        $this->data = json_decode(json_encode($recibo_pago[0] ?? []));
        $this->show = true;

    }
    
}
