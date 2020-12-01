<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseAPIController;
use App\Repositories\PostRepository;

class PostAPIController extends BaseAPIController
{
    private $postRepo;

    public function __construct(
        PostRepository $postRepo
    )
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $data = $this->postRepo->all();
        
        return $this->success('Post fetched successfully.', $data);
    }
}
