<?php

use App\Models\Process;
use Illuminate\Support\Facades\Log;
use App\Jobs\GenerateProcessLogsJob;
use Illuminate\Support\Facades\Route;
use App\Console\Commands\ProcessLogger;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Http\Controllers\ProcessController;

Route::get('/', function () {
    return 123;
});

Route::resource('processes', ProcessController::class);
