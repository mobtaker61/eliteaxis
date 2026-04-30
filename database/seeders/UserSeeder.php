<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eliteaxis.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        User::factory()
            ->count((int) (env('SEED_TEST_USERS_COUNT', 10)))
            ->create();
    }
}

