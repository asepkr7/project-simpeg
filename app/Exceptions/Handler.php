<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

   public function render($request, Throwable $exception)
{
    if ($exception instanceof ModelNotFoundException) {
        return response()->view('errors.404', [], 404);
    }

    if ($exception instanceof HttpExceptionInterface) {
        $statusCode = $exception->getStatusCode();
        $viewName = 'errors.' . $statusCode;
        if (view()->exists($viewName)) {
            return response()->view($viewName, [], $statusCode);
        }
    }

    if ($exception instanceof ValidationException) {
        return $this->convertValidationExceptionToResponse($exception, $request);
    }

    return parent::render($request, $exception);
}
}