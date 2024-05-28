<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class MigrateOffline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:migrate_offline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate offline database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        foreach (['public', 'imet', 'oecm'] as $db) {
            $db_file = database_path($db.'.sqlite');
            if (!file_exists($db_file)) {
                fopen($db_file, 'w');
            }
        }

        Artisan::call('migrate');

        return 0;
    }
}
