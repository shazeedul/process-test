<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Process;

class ProcessController extends Controller
{
    public function index()
    {
        $processes = Process::all();

        $formattedProcesses = [];
        foreach ($processes as $process) {
            $formattedProcesses[] = [
                'PID' => $process->pid,
                'Creation time' => Carbon::parse($process->created_at)->format('h:i A d.m.Y'),
            ];
        }
        return response()->json($formattedProcesses, 200);
    }

    public function store()
    {
        $process = new Process();
        $process->pid = rand(100000, 999999);
        $process->status = 'running';
        $process->save();

        $formattedProcesses[] = [
            'PID' => $process->pid,
            'Creation time' => Carbon::parse($process->created_at)->format('h:i A d.m.Y'),
        ];

        return response()->json([$formattedProcesses], 201);
    }

    public function show($pid)
    {
        $process = Process::with('logs')->where('pid', $pid)->first();

        $logs = $process->logs;

        $formattedLogs = [];
        foreach ($logs as $log) {
            $formattedLogs[] = [
                $log->creation_time
            ];
        }

        return response()->json(['logs' => $formattedLogs], 200);
    }

    public function destroy($pid)
    {
        $process = Process::where('pid', $pid)->first();
        $process->delete();

        return response()->json(['message' => '"' . $process->pid . '" ' . 'The Process has been successfully deleted'], 200);
    }
}
