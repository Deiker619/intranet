<?php

namespace App\Livewire\Constancia;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;


class ConstanciaGenerate extends Component
{
    public function render()
    {
        
        return view('livewire.constancia.constancia-generate');
    }
    public function generate_constancia_pdf(){
        
        
    }
}
