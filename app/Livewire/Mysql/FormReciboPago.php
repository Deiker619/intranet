<?php

namespace App\Livewire\Mysql;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FormReciboPago extends Component
{
    public $show;

    

    public function render()
    {
        return view('livewire.mysql.form-recibo-pago');
    }


    
    public function showReport(){
    $this->dispatch('post-created'); 
    }

    public function dataSigesp(){
        $personal = DB::connection('pgsql')->table('sno_personal')->select('nomper','cedper')->limit(20)->get();
        dd($personal);
    }
}
