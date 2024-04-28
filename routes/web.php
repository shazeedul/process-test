<?php

use App\Models\Process;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Console\Commands\ProcessLogger;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Http\Controllers\ProcessController;

Route::get('/', function () {
    $process = Process::find(1);
    Artisan::call('process:log', ['processId' => $process->pid]);
});

Route::resource('processes', ProcessController::class);
