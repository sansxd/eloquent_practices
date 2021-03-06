<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'Error' => 'Record not found'
            ], 404);
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'Error' => 'Resource not found'
            ], 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'Error' => 'Method is not allowed for the requested route',
            ], 405);
        }
        // if ($exception instanceof AuthorizationException) {
        //     return response()->json([
        //         'Error' => 'This action is unauthorized'
        //     ], 401);
        // }
        return parent::render($request, $exception);
    }
}
