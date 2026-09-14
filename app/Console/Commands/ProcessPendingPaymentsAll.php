<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessPendingPaymentsAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-pending-payments-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all pending PGPay payments from the past 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::channel('payment')->info('Running processPendingPaymentsAll...');

        processPendingPaymentsAll();

        Log::channel('payment')->info('Finished processing.');
    }
}
