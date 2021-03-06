<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default user
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@laravel8.com',
            'password' => Hash::make('Admin@123')
        ]);

        Team::create([
            'user_id' => $user->id,
            'name' => $user->name."'s Team",
            'personal_team' => $user->id,
        ]);
    }
}
