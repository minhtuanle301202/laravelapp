<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\LaravelIgnition\Exceptions\ViewException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
//            if ($e instanceof ViewException) {
//                return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
//            }
//
//            if ($e instanceof ErrorException) {
//                return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
//            }
        });
    }
}
