<?php

namespace App\Console\Commands\Imet;

use App\Http\Controllers\Imet\ImetController;
use App\Library\Utils\File\File;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Storage;
use Str;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import multiple IMETs JSON.';

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
        foreach ($this->storage->files() as $file) {
            if (Str::endsWith($file, '.json')) {
                $file_content = $this->storage->get($file);
                $json         = json_decode($file_content, true);
                if ($json !== null && isset($json['Imet']['version'])) {
                    $this->info('Importing file ' . $file . '...');
                    try {
                        $response = (new ImetController())->import(new Request(), $json)->getContent();
                        if (Str::contains($response, 'success')) {
                            $this->info('Successfully imported.');
                        }
                    } catch (\Exception $e) {
                        $this->error('Error: ' . $e->getMessage());
                    }
                    $i++;
                }
            }
        }
        if($i>0){
            $this->info('All done.');
        } else {
            $this->warn('Nothing to import.');
            $this->warn('No IMET json files found in storage/app/public.');
        }
        return 0;
    }
}
