<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Jobs;
use Exception;
use Illuminate\Console\Command;

class CalculateScores extends Command
{
    use Utils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:calculate_scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate all IMET and OECM scores.';


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
        try{
            $this->dispatch(Jobs\CalculateScores::class);
            $this->info('Command successfully executed.');
            return self::SUCCESS;

        } catch (Exception $e) {
            $this->error('Execution filed');
            return self::FAILURE;
        }

    }

}
