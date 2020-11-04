<?php

namespace App\Exceptions;

use App\Models\LogException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are reported.
     * 
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        if(!App::environment('imetoffline')){
            LogException::report($exception, request());
        }
        parent::report($exception);
    }

    /**
     * Override prepareResponse(): redirect response to error page (in PRODUCTION)
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function prepareResponse($request, Throwable $e)
    {
        if(App::environment('production') && !$this->isHttpException($e)){
            ob_get_clean();
            return response()->view('errors.500', [
                'exception' => $e
            ]);
        } else {
            return parent::prepareResponse($request, $e);
        }
    }
}
