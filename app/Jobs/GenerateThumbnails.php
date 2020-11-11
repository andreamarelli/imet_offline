<?php

namespace App\Jobs;

use App\Library\Utils\Thumbnail;
use App\Models\Catalogue\Catalogue;
use App\Models\Catalogue\Modules\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class GenerateThumbnails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $time_start  = microtime(true);

        $files = File::select(['id', 'document_id'])->get();
        foreach ($files as $file){
            $hash = File::getHash( $file->id);
            if(!Thumbnail::exists($hash)){
                Thumbnail::generateByHash($hash);
            }
        }

        $execution_time = round((microtime(true) - $time_start), 2);
        Log::info('Scheduled job executed in '.$execution_time.' seconds: GenerateThumbnails.');
    }
}
