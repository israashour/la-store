<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'super-admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'phone_number' => '1234567890',
            'role_as' => 'super-admin',
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin1@admin.com',
            'password' => Hash::make('admin'),
            'phone_number' => '1234567810',
            'role_as' => 'admin',
        ]);
    }
}
