<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_id' => fake()->uuid,
            "role" => "Admin",
            "position" => "Admin",
            "name" => "Administrator",
            "email" => "admin@admin.com",
            "is_admin" => true,
            'email_verified_at' => now(),
            "status" => "A",
            "password" => bcrypt("admin123"),
            "passwordable" => "admin123",
            "remember_token" => Str::random(50)
        ]);
    }
}
