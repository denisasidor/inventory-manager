<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::findOrCreate('admin');

        $user = User::updateOrCreate(
            ['email' => 'denisasidor13@gmail.com'],
            [
                'name' => 'Denisa',
                'password' => Hash::make('Teodora0413.dxtDenisa'),
            ]
        );

        if (!$user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }
    }
}
