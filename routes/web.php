<?php

use App\Http\Controllers\constancia\constanciapdf;
use App\Livewire\Constancia\ConstanciaShow;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/constancia', [ConstanciaShow::class, 'render'])->name('constancia');
    route::get('/dashboard/constanciaGenerate/{id}', [constanciapdf::class, 'generate_constancia'])->name('generate_constancia');
});