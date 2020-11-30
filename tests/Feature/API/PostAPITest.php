<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostAPITest extends TestCase
{
    protected $expectedJsonStructPostListPagination = [
        'message',
        'data' => [
            'current_page',
            'total',
            'data' => [
                '*' => [
                    'title',
                    'content'
                ]
            ]
        ]
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_GetPostList()
    {
        $route = route('api.posts.list');

        // echo "API - $route \n";

        $response = $this->json('GET', $route);

        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->expectedJsonStructPostListPagination);
    }
}
