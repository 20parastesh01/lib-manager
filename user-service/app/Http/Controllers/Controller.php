<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($message, $data, $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => $status
        ]);
    }

    public function failureResponse($message, $status)
    {
        return response()->json([
            'message' => $message,
            'code' => $status
        ]);
    }
}
