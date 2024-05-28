<?php

namespace App\Console\Commands;

use AndreaMarelli\ImetCore\Helpers\Database;
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
        foreach ([Database::COMMON_CONNECTION, Database::IMET_CONNECTION, Database::OECM_CONNECTION] as $db) {
            $db_file = database_path($db.'.sqlite');
            if (!file_exists($db_file)) {
                fopen($db_file, 'w');
            }
        }

        Artisan::call('migrate');
        Artisan::call('imet:populate_species');

        return 0;
    }
}
