<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Jobs;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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

    private $storage;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storage = Storage::disk('imet_db_sql');
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
        $basename = basename($sql_file);

        // File path as passed
        if(Storage::exists($sql_file)){
            $this->dispatch(Jobs\ApplySQL::class, $sql_file);
            return 0;
        }

        // File from vendor folder
        else if($this->storage->exists($basename)){
            $this->dispatch(Jobs\ApplySQL::class, $this->storage->path($basename));
            return 0;
        }

        // File not found
        else {
            $this->error('File not found at ' . $this->storage->path($basename). '. Cannot apply SQL!!');
            return 1;
        }


    }

}
