<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Jobs;
use Illuminate\Console\Command;

class PopulateMetadata extends Command
{
    use Utils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:populate_metadata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate metadata in IMET assessment schemas';

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
        $this->dispatch(Jobs\PopulateMetadata::class);
        return 0;
    }

}
