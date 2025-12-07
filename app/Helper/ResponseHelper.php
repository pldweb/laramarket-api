<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success($data = null, $message = null, $statusCode = 200): JsonResponse
    {
        return self::jsonResponse(true, $message, $data, $statusCode);
    }

    public static function error($data = null, $message = null, $statusCode = 400): JsonResponse
    {
        return self::jsonResponse(false, $message, $data, $statusCode);
    }

    public static function jsonResponse($success, $message, $data, $statusCode): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
