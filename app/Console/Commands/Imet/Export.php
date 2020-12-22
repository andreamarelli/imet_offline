<?php

namespace App\Console\Commands\Imet;

use App\Http\Controllers\Imet\ImetController;
use App\Library\Utils\File\File;
use App\Models\Imet\Imet;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Storage;
use Str;

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

    private $storage;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storage = Storage::disk(File::PUBLIC_STORAGE);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $i=0;
        $imets = Imet::orderBy('name')->orderBy('Year')->get();
        $this->info($imets->count() . ' IMETS found.');
        foreach ($imets as $imet){
            (new ImetController())->export($imet, true);
            $this->info($imet->name . ' (' . $imet->Year . ') exported.');
            $i++;
        }
        $this->info($i . ' IMETS exported (storage/framework/cache/).');

        return 0;
    }
}
