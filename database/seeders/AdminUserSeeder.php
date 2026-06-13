<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super-admin')->first();

        User::firstOrCreate(
            ['email' => 'yinkatosho@gmail.com'],
            [
                'name'     => 'KayessAdmin',
                'password' => Hash::make('k0soM0sH3@777'),
                'role_id'  => $superAdminRole->id,
                'is_active' => true,
            ]
        );
    }
}
