<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.co',
            'password' => bcrypt('admin123'),
        ]);
    }
}
