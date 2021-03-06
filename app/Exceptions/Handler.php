<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
	
	/**
     * Changes the behavior of callbacks, for exceptions thrown in API routes.
     *
     */

    public function render($request, Throwable $e)
    {

        if ($request->is('api/*')){
            if ($e instanceof ValidationException) {
                return response()->json(
                    $e->errors(),
                    $e->status
                );
            }
        }

        return parent::render($request, $e);
    }
}
