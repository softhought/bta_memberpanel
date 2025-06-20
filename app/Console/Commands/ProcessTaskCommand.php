<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessTaskCommand extends Command
{
    protected $signature = 'task:process';
    protected $description = 'Process tasks daily at 12AM';

    public function handle()
    {
        processTask();
    }
}
