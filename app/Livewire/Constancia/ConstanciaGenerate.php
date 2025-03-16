<?php

namespace App\Livewire\Constancia;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;


class ConstanciaGenerate extends Component
{
    public function render()
    {

        return view('livewire.constancia.constancia-generate');
    }
    public function generate_constancia_pdf()
    {
      /*  $this->dispatch('showAlertSuccess','Hola'); */


        redirect()->route('generate_constancia'); 

    }
}
