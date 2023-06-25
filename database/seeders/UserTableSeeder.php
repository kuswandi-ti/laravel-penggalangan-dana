<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::factory(5)->create();

        $user = User::first();
        $user->name = 'Administrator';
        $user->email = 'admin@mail.com';
        $user->role_id = 1;
        $user->save();
    }
}
