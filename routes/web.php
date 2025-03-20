<?php

use App\Http\Controllers\constancia\constanciapdf;
use App\Http\Controllers\recibo_pago\recibo_pago_pdf;
use App\Livewire\Constancia\ConstanciaShow;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'statusPersonal'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/constancia', [ConstanciaShow::class, 'render'])->name('constancia');


    /* 
        //Rutas para generar PDF'S 
    */
    route::get('/dashboard/constanciaGenerate/', [constanciapdf::class, 'get_datos'])->name('generate_constancia');
    route::get('/dashboard/generate_recibo_pago', [recibo_pago_pdf::class, 'generate_recibo_pago'])->name('generate_recibo_pago');
});
