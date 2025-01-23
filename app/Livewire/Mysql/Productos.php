<?php

namespace App\Livewire\Mysql;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

class Productos extends Component
{
    public function render()
    {

        $personal = DB::connection('pgsql')->table('sno_personal')->select('nomper','cedper')->limit(20)->get();
        return view('livewire.mysql.productos', compact( 'personal'));
    }
}
