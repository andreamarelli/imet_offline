<?php

namespace App\Console\Commands\Imet;

use App\Jobs;
use Illuminate\Console\Command;

class ApplySQL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:apply_sql {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply SQL file to IMET offline database';

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
        $sql_file = $this->argument('filename');
        $this->dispatch(Jobs\ImetOffline\ApplySQL::class, $sql_file);
    }


    private function dispatch($item, $args=null){
        $time_start  = microtime(true);
        $this->info('Executing '.$item);
        $item::dispatch($args);
        $this->info('Finished in '.round((microtime(true) - $time_start), 2).' seconds');
    }
}
