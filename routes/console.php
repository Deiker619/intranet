<?php

use App\Console\Commands\daily;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;


/* Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly(); */

/* Artisan::command('app:daily', function () {
    Log::info('Tarea programada ejecutada');
})->everySecond(); */

Schedule::command('app:daily')->everyMinute();
