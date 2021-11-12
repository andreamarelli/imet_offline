<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PostUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:post_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute custom code after IMET offline update';

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
        return 0;
    }
}
