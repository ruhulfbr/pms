<?php

namespace Modules\AuthKit\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HandleResponse
{
    public static function success($data = [], $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], $statusCode);
    }

    public static function error($message, $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}
