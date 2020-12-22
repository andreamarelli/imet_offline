<?php

namespace App\Console\Commands\Imet;

use App\Jobs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:init_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize IMET offline database';

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
        $sql_files = \Storage::disk('imet')->files();
        sort($sql_files);
        foreach ($sql_files as $sql_file){
            $this->dispatch(Jobs\ImetOffline\ApplySQL::class, $sql_file);
        }

        $this->dispatch(Jobs\ImetOffline\PopulateMetadata::class);
        $this->dispatch(Jobs\ImetOffline\PopulateSpecies::class);
    }


    private function dispatch($item, $args=null){
        $time_start  = microtime(true);
        $this->info('Executing '.$item);
        $item::dispatch($args);
        $this->info('Finished in '.round((microtime(true) - $time_start), 2).' seconds');
    }
}
