<?php

namespace App\Livewire\Mysql\Deducciones;

use Livewire\Component;

class Deducciones extends Component
{
    public $data;
    public function mount($data){
        $this->data = $data;
    }
    public function totalDeducciones(){
        $totalAsignaciones = 0;
        foreach($this->data->asignaciones as $asignacion){
            $totalAsignaciones += $asignacion->valsal;
        }
    }
    public function render()
    {
        return view('livewire.mysql.deducciones.deducciones');
    }
}
