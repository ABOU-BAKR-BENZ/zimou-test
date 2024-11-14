<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@zimouexpress.com',
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => 'ZIMOU-EXPRESS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
