<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

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
            if ($this->shouldReturnJson(request(),$e)) {
                return $this->handleJsonResponse($e);
            }
        });
    }

    protected function shouldReturnJson($request, Throwable $e): bool
    {
        return $request->expectsJson();
    }

    protected function handleJsonResponse(Throwable $e): ApiResponse
    {
        if (env('APP_DEBUG')) {
            return new ApiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return new ApiResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
