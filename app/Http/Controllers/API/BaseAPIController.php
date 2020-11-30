<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Response;
use Request;

class BaseAPIController extends Controller
{
    public function success($message, $data=NULL, $code=200, $resourceClass=NULL)
    {
        return Response::json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error($message, $errors, $code = 404)
    {
        return Response::json([
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

}
