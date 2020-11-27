<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $name = 'Tester';

        $user = User::factory()->make([
            'name' => $name
        ]);

        $this->assertNotEmpty($user->name);
        $this->assertEquals($name, $user->name);
    }
}
