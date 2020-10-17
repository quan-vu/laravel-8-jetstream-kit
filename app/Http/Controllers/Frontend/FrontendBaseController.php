<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Response;


class FrontendBaseController extends Controller
{
    private const VIEW_PREFIX = 'frontend';

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
