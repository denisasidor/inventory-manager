<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::findOrCreate('admin');
        $company = Company::create(['name' => 'DenisaFashion']);

        $user = User::updateOrCreate(
            ['email' => 'denisaisdor13@gmail.com'],
            [
                'name' => 'Denisa',
                'password' => Hash::make('Teodora0413.dxtDenisa'),
                'company_id' => $company->id,
            ]
        );

        if (!$user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }

        $company = Company::create(['name' => 'AditiuFashion']);

        $user = User::updateOrCreate(
            ['email' => 'sorecauadrian@gmail.com'],
            [
                'name' => 'Aditiu',
                'password' => Hash::make('admin'),
                'company_id' => $company->id,
            ]
        );

        if (!$user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }
    }
}
