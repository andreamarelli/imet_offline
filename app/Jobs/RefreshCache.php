<?php

namespace App\Jobs;

use App\Http\Controllers\Project\ProjectController;
use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use \App\Http\Controllers\AnalyticalPlatform\Biodiversity;
use \App\Http\Controllers\AnalyticalPlatform\ForestManagement;

class RefreshCache implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Utils;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $time_start  = microtime(true);

        $request = new Request();
        $request->merge(['no_cache' => 'true']);

        // ###### Analytical Platform ######
        Biodiversity\RegionalController::api($request);
        ForestManagement\RegionalController::api($request);
        foreach(Country::ofac()->noAwy()->get()->pluck('iso3')->toArray() as $iso3) {
            Biodiversity\NationalController::api($request, $iso3);
            ForestManagement\NationalController::api($request, $iso3);
        }

        // ###### Project Platform ######
        ProjectController::api_project_platform($request);

        $execution_time = round((microtime(true) - $time_start), 2);
        Log::info('Scheduled job executed in '.$execution_time.' seconds: RefreshCache.');
    }
}
