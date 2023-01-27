<?php

namespace AndreaMarelli\ImetCore\Commands;

use ErrorException;
use AndreaMarelli\ImetCore\Jobs;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class InitDB extends Command
{
    use Utils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:init_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize IMET offline database';

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
        try{
            
            $sql_files = $this->storage->files();
            sort($sql_files);
            foreach ($sql_files as $sql_file){
                if(Str::endsWith($sql_file, '.sql')){
                    $this->dispatch(Jobs\ApplySQL::class, $this->storage->path($sql_file));
                }
            }

            $this->dispatch(Jobs\PopulateMetadata::class);
            $this->dispatch(Jobs\PopulateSpecies::class);

            return self::SUCCESS;

        } catch (FileNotFoundException|QueryException|ErrorException $e) {
            $this->error('Error initializing DB.');
            return self::FAILURE;
        }
    }
}
