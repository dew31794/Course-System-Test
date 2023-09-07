<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ApiController extends Controller
{

    protected function respond($data, $statusCode = 200, $headers = [])
    {
        return response()->json($data, $statusCode, $headers);
    }

    protected function respondOther($message, $statusCode = 200, $headers = [])
    {
        return $this->respond([
            'message' => $message,
            'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s.uP T')
        ], $statusCode, $headers);
    }

    protected function respondSuccess($data, $statusCode = 200, $headers = [])
    {
        return $this->respond([
            'Status' => 'Success',
            'Data' => $data,
            'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s.uP T')
        ], $statusCode, $headers);
    }

    protected function respondSuccessMsg($message, $statusCode = 200, $headers = [])
    {
        return $this->respond([
            'Status' => 'Success',
            'message' => $message,
            'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s.uP T')
        ], $statusCode, $headers);
    }

    protected function respondError($message, $code = '')
    {
        return $this->respond([
            'Status' => 'Failure',
            'ErrorMessage' => $message,
            'Code' => $code,
            'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s.uP T')
        ]);
    }

    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respondError($message, 401);
    }

    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, 403);
    }

    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respondError($message, 404);
    }

    protected function respondUnprocessableEntity($message = 'Unprocessable Entity')
    {
        return $this->respondError($message, 422);
    }

    protected function respondInternalError($message = 'Internal Error')
    {
        return $this->respondError($message, 500);
    }
}
