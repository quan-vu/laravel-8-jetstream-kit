<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Response;


class AdminBaseController extends Controller
{
    private const VIEW_PREFIX = 'admin';

    public function sendSuccess($message, $data=NULL)
    {
        return Response::json([
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function sendError($errors, $code = 404)
    {
        return Response::json([
            'errors' => $errors,
        ], $code);
    }

    public function frontendView($view)
    {
        return view(self::VIEW_PREFIX.'.'.$view);
    }

}
