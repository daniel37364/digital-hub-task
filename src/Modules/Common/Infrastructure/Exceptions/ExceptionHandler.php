<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Exceptions;

use Throwable;
use Modules\Common\Services\ApiResponseFormatter;
use Modules\Common\Application\Exceptions\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;

class ExceptionHandler extends BaseExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \RuntimeException) {
            return ApiResponseFormatter::error('Runtime Exception', 400);
        }
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return ApiResponseFormatter::error('Validation Error', 422, $exception->errors());
        }
        if ($exception instanceof ModelNotFoundException) {
            return ApiResponseFormatter::error('Resource not found', 404);
        }
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return ApiResponseFormatter::error('Endpoint not found', 404);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return ApiResponseFormatter::error('Method not allowed', 405);
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return ApiResponseFormatter::error('Unauthenticated', 401);
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return ApiResponseFormatter::error('Forbidden', 403);
        }

        if ($exception instanceof \Illuminate\Database\QueryException) {
            return ApiResponseFormatter::error('Database error', 500);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            return ApiResponseFormatter::error($exception->getMessage(), $exception->getStatusCode());
        }

        return ApiResponseFormatter::error($exception->getMessage(), 500);
    }
}
