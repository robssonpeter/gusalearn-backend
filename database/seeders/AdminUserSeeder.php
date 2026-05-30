<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gusalear.co.tz'],
            [
                'name'     => 'GusaLearn Admin',
                'password' => Hash::make('gusa@admin2026'),
                'is_admin' => true,
                'language' => 'en',
            ]
        );
    }
}
