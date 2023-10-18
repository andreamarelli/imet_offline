<?php

namespace AndreaMarelli\ImetCore\Jobs;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * use this job to update assessments effectiveness scores
 * every time a change is made in an assessment
 * It will cache the scores pre imet in json format
 */
class PopulateImetScores implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;

    private string $log_label = 'Job Polulate Imet Scores :';

    private function updateRecords($records){
        foreach($records as $record){
            if($record->version ===Imet::IMET_V2) {
                $assessments = V2StatisticsService::get_scores($record->FormID, 'ALL', false);
            } else {
                $assessments = V1ToV2StatisticsService::get_scores($record->FormID, 'ALL', false);
            }
            Log::info($this->log_label.' Insert record .'.$record->FormID);
            $imet = ReportController::report_cache_scores($record->FormID, $assessments);
            $imet->touch();
            Log::info($this->log_label.' '.$imet->UpdateDate);
        }
    }

    private function updateTimestampFile(){
        $timestamp = now()->toDateTimeString();
        Storage::put('job-timestamp.txt', $timestamp);
        Log::info($this->log_label.' timestamp stored.  '.$timestamp);
    }

    public function handle()
    {
        Log::info($this->log_label.' started.');
        if (Storage::exists('job-timestamp.txt')) {
            $previousTimestamp = Storage::get('job-timestamp.txt');
            Log::info($this->log_label.' timestamp exist.  '.$previousTimestamp);
            $records = Imet::select(['FormID', 'version'])->where('UpdateDate', '>', $previousTimestamp)->get();
        } else {
            $records = Imet::select(['FormID', 'version'])->get();
            Log::info('Retrieved records. '.$records->count());
        }
        $this->updateRecords($records);
        $this->updateTimestampFile();
        Log::info($this->log_label.' Ended.');
    }
}
