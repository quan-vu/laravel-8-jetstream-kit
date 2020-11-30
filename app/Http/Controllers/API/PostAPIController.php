<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseAPIController;
use App\Models\Post;

class PostAPIController extends BaseAPIController
{
    public function index()
    {
        $data = Post::paginate(10);
        
        return $this->success('Post fetched successfully.', $data);
    }
}
