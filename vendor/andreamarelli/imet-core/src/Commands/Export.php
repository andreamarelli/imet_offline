<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller as ImetController;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use Illuminate\Console\Command;


class Export extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export IMETs to JSON.';

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
        $i=0;
        $imets = Imet::orderBy('name')->orderBy('Year')->get();
        $this->info($imets->count() . ' IMETS found.');
        foreach ($imets as $imet){
            (new ImetController())->export($imet, false, true);
            $this->info($imet->name . ' (' . $imet->Year . ') exported.');
            $i++;
        }
        $this->info($i . ' IMETS exported (storage/framework/cache/).');

        return 0;
    }
}
