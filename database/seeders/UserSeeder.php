<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'Masaid Fairus',
            'email' => 'masaidfairus@gmail.com',
            'username' => 'masaidfairus',
            'role' => 'user',
            'password' => bcrypt('12345678')
        ]);

    }
}
