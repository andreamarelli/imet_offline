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
        $sql_file = $this->argument('filename');

        if(!Storage::exists($sql_file)){
            $this->error('File not found at ' . $sql_file);
            $sql_file = Storage::disk('imet_db_sql')->path(basename($sql_file));
            $this->info('Trying from vendor folder (' . $sql_file . ')');
        }
        if(!Storage::exists($sql_file)){
            $this->error('File not found at ' . $sql_file. '. Cannot apply SQL!!');
            return 1;
        }

        $this->dispatch(Jobs\ApplySQL::class, $sql_file);
        return 0;
    }

}
