<?php

namespace App\Console\Commands;

use App\Models\Process;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class ProcessLogger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:log {processId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $processId = $this->argument('processId');
        if ($processId) {
            Log::info("Log generated for process: $processId");
        }
    }
}
