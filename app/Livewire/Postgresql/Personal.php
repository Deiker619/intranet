<?php

namespace App\Livewire\Postgresql;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Personal extends Component
{
    public function render()
    {
        /* $personal = DB::connection('pgsql')->table('sno_personal')->select('nomper','cedper')->limit(20)->get();
        return view('livewire.postgresql.personal', compact('personal')); */
    }
}
