<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Components\API;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    use API;

    public function under_dev()
    {
        return trans('common.in_development');
    }

}
