<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DeskeraJobs;

class DeskeraCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:deskeraCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync process from deskera to onthego system';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        for($x=0; $x<10; $x++) {
            DeskeraJobs::dispatch();
        }
         
        return 0;
    }
}
