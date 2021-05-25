<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;

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
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof TokenExpiredException) {
            return response(['error' => 'Token is expired'], \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
        }else if($exception instanceof TokenInvalidException){
            return response(['error' => 'Token is invalid'], \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
        }else if($exception instanceof JWTException){
            return response(['error' => 'Token is not provided'], \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
        }else if($exception instanceof TokenBlacklistedException){
            return response(['error' => 'Token can not be used, get new one'], \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $exception);
        }

}
