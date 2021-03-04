<?php

namespace App\Console\Commands\Imet;

use App\Jobs;
use Illuminate\Console\Command;

class PopulateSpecies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:populate_species';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate species table from DOPA API';

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
        $this->dispatch(Jobs\ImetOffline\PopulateSpecies::class);
    }


    private function dispatch($item, $args=null){
        $time_start  = microtime(true);
        $this->info('Executing '.$item);
        $item::dispatch($args);
        $this->info('Finished in '.round((microtime(true) - $time_start), 2).' seconds');
    }
}
