<?php

namespace App\Http\Controllers\API;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => TRUE,
            'message' => null
        ],
        'data' => null
    ];

    public static function success($code = 200, $message = null, $data = null)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($code = 404, $message = null, $data = null)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = FALSE;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
