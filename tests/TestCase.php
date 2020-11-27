<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // protected $user;

    // protected function setUp()
    // {
    //     $this->user = User::factory()->create();
    //     parent::setUp();
    // }

    // protected function getRandomUser()
    // {
    //     return User::first();
    // }
}
