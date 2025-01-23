<?php

namespace App\Livewire\Mysql;

use App\Models\User;
use Livewire\Component;

use Illuminate\Support\Facades\DB;

class Productos extends Component
{
    public function render()
    {
        $usuarios = User::limit(5)->get();
        return view('livewire.mysql.productos', compact( 'usuarios'));
    }
}
