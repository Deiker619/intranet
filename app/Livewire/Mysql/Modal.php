<?php

namespace App\Livewire\Mysql;

use Livewire\Component;
use Livewire\Attributes\On; 

class Modal extends Component
{
    public $show = false; 
    
    public function render()
    {
        return view('livewire.mysql.modal');
    }

    #[On('post-created')] 
    public function showModal(){
        $this->show = true;
    }
}
