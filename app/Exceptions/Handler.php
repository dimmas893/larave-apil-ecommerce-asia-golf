<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;


use Throwable;
use Exception;

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
        //

        $this->renderable(function (ValidationException $e) {

            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => $e->getMessage()
            ], 200);
        });

        // public function render($request, Exception $e) {
        //     // if($e instanceof ValidationException) {

        //     // }
        // }
    }



}