<?php

use App\Models\Process;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use App\Jobs\GenerateProcessLogsJob;
use Illuminate\Support\Facades\File;
use Monolog\Formatter\LineFormatter;
use Illuminate\Support\Facades\Route;
use App\Console\Commands\ProcessLogger;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Http\Controllers\ProcessController;

Route::get('/', function (Logger $logger) {
    $process     = Process::findOrFail(1);
    $logFile = storage_path('logs/process.log');

    if (File::exists($logFile)) {
        // Read the contents of the log file
        $logs = File::get($logFile);

        // Split the log file contents into an array of lines
        $logLines = explode(PHP_EOL, $logs);

        // Filter log lines based on the provided PID
        $filteredLogs = [];
        foreach ($logLines as $line) {
            // Check if the line contains the provided PID
            if (strpos($line, "PID: $process->pid") !== false) {
                $filteredLogs[] = $line;
            }
        }

        // Return filtered logs as JSON response
        return response()->json(['process' =>  $process, 'logs' => $filteredLogs], 200);
    } else {
        return response()->json(['message' => 'Process log file not found'], 404);
    }
});

Route::resource('processes', ProcessController::class);
