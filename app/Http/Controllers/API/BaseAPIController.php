<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Response;


class BaseAPIController extends Controller
{
    public function sendSuccess($message, $data=NULL, $code=200)
    {
        return Response::json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function sendError($errors, $code = 404)
    {
        return Response::json([
            'errors' => $errors,
        ], $code);
    }

    public function sendResource($message, $data=NULL, $code=200, $resourceClass=NULL)
    {
        return Response::json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

}
