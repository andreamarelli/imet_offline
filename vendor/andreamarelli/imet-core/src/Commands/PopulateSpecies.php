<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Jobs;
use Illuminate\Console\Command;

class PopulateSpecies extends Command
{
    use Utils;

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
     * @return int
     */
    public function handle(): int
    {
        $this->dispatch(Jobs\PopulateSpecies::class);
        return 0;
    }


}
