<?php

namespace AndreaMarelli\ImetCore\Jobs;

use AndreaMarelli\ImetCore\Jobs\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplySQL implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;

    private $sql_file;

    /**
     * Create a new job instance.
     *
     * @param $sql_file
     */
    public function __construct($sql_file)
    {
        $this->sql_file = $sql_file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        static::log('Applying file: '.basename($this->sql_file));
        DB::unprepared(
            file_get_contents($this->sql_file)
        );
    }
}
