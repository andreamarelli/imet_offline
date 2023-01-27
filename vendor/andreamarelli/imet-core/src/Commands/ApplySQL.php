<?php

namespace AndreaMarelli\ImetCore\Commands;

use ErrorException;
use AndreaMarelli\ImetCore\Jobs;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;
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

        try{

            // Try with exact path provided by argument
            if(Storage::exists($sql_file)){
                $this->dispatch(Jobs\ApplySQL::class, $sql_file);
            }
            // try with vendor folder (imet-core/database)
            else {
                $this->dispatch(Jobs\ApplySQL::class, $this->storage->path($basename));
            }

            return self::SUCCESS;

        } catch (FileNotFoundException $e) {
            $this->error('File not found at ' . $this->storage->path($basename). '. Cannot apply SQL!!');
            return self::FAILURE;
        } catch (QueryException|ErrorException $e) {
            $this->error('Error applying file ' . $this->storage->path($basename). '!!');
            return self::FAILURE;
        }


    }

}
