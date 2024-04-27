<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProcessController extends Controller
{
    public function index()
    {
        return Process::all();
    }

    public function store(Request $request)
    {
        $process = new Process();
        $process->name = $request->input('name');
        $process->save();

        // Start generating logs for the new process
        $this->startGeneratingLogs($process);

        return $process;
    }

    public function show($id)
    {
        return Process::findOrFail($id);
    }

    public function destroy($id)
    {
        $process = Process::findOrFail($id);
        $process->delete();

        // Stop generating logs for the deleted process
        $this->stopGeneratingLogs($process);

        return response()->json(['message' => 'Process deleted successfully']);
    }

    // Custom method to start generating logs for a process
    private function startGeneratingLogs(Process $process)
    {
        $processName = $process->name;
        $logInterval = 5; // seconds

        // Using Laravel's task scheduling to generate logs
        $schedule = app()->make(\Illuminate\Console\Scheduling\Schedule::class);
        $schedule->call(function () use ($processName) {
            Log::info("Log generated for process: $processName");
        })->everyFiveSeconds()->name("process_log_$processName")->withoutOverlapping()->runInBackground();
    }

    // Custom method to stop generating logs for a process
    private function stopGeneratingLogs(Process $process)
    {
        $processName = $process->name;
        \Illuminate\Console\Scheduling\Schedule::delete("process_log_$processName");
    }
}
