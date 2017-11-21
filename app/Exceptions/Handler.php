<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // If app is in debug mode always display the error page.
        if (env('APP_DEBUG', true)) {
            // App is in debug mode. Display all errors.
            dd($exception, $request, $exception->getCode());

            return parent::render($request, $exception);
        }

        // Render well-known exceptions here
        switch (get_class($exception)) {
            case "Illuminate\Auth\AuthenticationException":
                return $this->unauthenticated($request, $exception);
                break;
            case "Symfony\Component\HttpKernel\Exception\NotFoundHttpException":
            case "Illuminate\Validation\ValidationException":
                return parent::render($request, $exception);
                break;
            case "Illuminate\Auth\Access\AuthorizationException":
                $exception = new HttpException(403, $exception->getMessage());
                break;
            case "Illuminate\Http\Exceptions\HttpResponseException":
                return $exception->getResponse();
                break;
            case "Illuminate\Database\Eloquent\ModelNotFoundException":
                //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
            case "Illuminate\Database\QueryException":
            default:
                return view('errors.500', compact($exception));
        }

        if ($this->isHttpException($exception)) {
            return $this->toIlluminateResponse($this->renderHttpException($exception), $exception);
        } else {
            return $this->toIlluminateResponse($this->convertExceptionToResponse($exception), $exception);
        }
    }
}
