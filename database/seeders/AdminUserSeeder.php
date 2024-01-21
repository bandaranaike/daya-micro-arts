<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => config('permission.admin_email')],
            ['name' => 'admin', 'password' => Hash::make(env('ADMIN_PASSWORD', '=ey)Zdkb^8y$%w~'))]
        );
    }
}
