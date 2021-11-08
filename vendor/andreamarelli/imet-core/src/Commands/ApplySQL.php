<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Jobs;
use Illuminate\Console\Command;

class ApplySQL extends Command
{
    use Utils;

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
     * @return int
     */
    public function handle(): int
    {
        $sql_file = $this->argument('filename');
        $this->dispatch(Jobs\ApplySQL::class, $sql_file);
        return 0;
    }

}
