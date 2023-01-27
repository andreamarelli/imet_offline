<?php

namespace AndreaMarelli\ImetCore\Jobs;

use ErrorException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

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
     * @throws FileNotFoundException
     */
    public function handle()
    {
        static::log('Applying file: '.basename($this->sql_file));
        try{
            $file_content = file_get_contents($this->sql_file);
        } catch (ErrorException $e){
            throw new FileNotFoundException();
        }
        DB::unprepared($file_content);
    }
}
