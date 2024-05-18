<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse as HttpJsonResponse;

class JsonResponse
{
    public static function success($data, $message = 'Success', $code = 200): HttpJsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message, $code = 400): HttpJsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
