<?php

namespace App\Jobs\ImetOffline;

use App\Jobs\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class InitDB implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;

    private $sql_files;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sql_files = [
            'IMET.01-offline.sql',
            'IMET.02-assessment.sql',
            'IMET.03-populate.sql',
            'IMET.04-countries.sql',
            'IMET.05-currencies.sql',
            'IMET.06-pas_ofac.sql',
            'IMET.07-pas_biopama.sql',
            'IMET.08-update_to_v2.sql',
            'IMET.09-assessment_v2.sql'
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->sql_files as $sql_file){
            static::log('Applying file: '.$sql_file);
            DB::unprepared(
                file_get_contents(base_path().'/database/imet_offline/'.$sql_file)
            );
        }
    }
}
