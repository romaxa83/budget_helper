<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    protected function successJsonMessage($message, $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $message,
            'success' => true
        ], $code);
    }

    protected function errorJsonMessage($message, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        $code = 0 === $code ? Response::HTTP_INTERNAL_SERVER_ERROR : $code;

        return response()->json([
            'data' => $message,
            'success' => false
        ], $code);
    }
}
