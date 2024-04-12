<?php

namespace AndreaMarelli\ModularForms\Controllers;

use AndreaMarelli\ModularForms\Controllers\Traits\API;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 *
 * @package AndreaMarelli\ModularForms\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    use API;

}
