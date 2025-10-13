<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

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
    protected $description = 'Command description';

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
