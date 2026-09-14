<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
    protected $description = 'Process pending PGPay payments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::channel('payment')->info("Running hourly processPendingPayments...");

        processPendingPayments();

        Log::channel('payment')->info("Finished processing.");
    }
}
