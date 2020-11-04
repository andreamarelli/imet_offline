<?php

namespace App\Jobs;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        $request = new Request();
        $request->merge(['no_cache' => 'true']);

        \App\Http\Controllers\AnalyticalPlatform\Biodiversity\RegionalController::api($request);
        //\App\Http\Controllers\AnalyticalPlatform\ForestManagement\RegionalController::api($request);
        foreach(\App\Models\Country::ofac()->noAwy()->get()->pluck('iso3')->toArray() as $iso3) {
        //    \App\Http\Controllers\AnalyticalPlatform\Biodiversity\NationalController::api($request, $iso3);
        //    \App\Http\Controllers\AnalyticalPlatform\ForestManagement\NationalController::api($request, $iso3);
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}