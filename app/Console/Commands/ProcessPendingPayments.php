<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class ProcessPendingPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-pending-payments';

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
        Log::info("Running hourly processPendingPayments...");

        processPendingPayments();

        Log::info("Finished processing.");
    }
}
