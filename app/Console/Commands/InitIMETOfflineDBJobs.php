<?php

namespace App\Console\Commands;

use App\Jobs;
use Illuminate\Console\Command;

class InitIMETOfflineDBJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init_imet_offline_db:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch all the jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->dispatch(Jobs\ImetOffline\InitDB::class);
        $this->dispatch(Jobs\ImetOffline\PopulateMetadata::class);
        $this->dispatch(Jobs\ImetOffline\PopulateSpecies::class);
    }


    private function dispatch($item){
        $time_start  = microtime(true);
        $this->info('Executing '.$item);
        $item::dispatch();
        $this->info('Finished in '.round((microtime(true) - $time_start), 2).' seconds');
    }
}
