<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles si no existen
        $roles = ['superadmin', 'admin', 'usuario'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear Superadmin
        $superadmin = User::firstOrCreate(
            ['email' => 'nelis@ejemplo.com'],
            [
                'name' => 'Nelis Cano',
                'password' => Hash::make('12345678'),
            ]
        );
        $superadmin->assignRole('superadmin');

        // Crear Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@fesc.com'],
            [
                'name' => 'Admin FESC',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('admin');

        // Crear Usuario normal
        $usuario = User::firstOrCreate(
            ['email' => 'usuario@ejemplo.com'],
            [
                'name' => 'Usuario FESC',
                'password' => Hash::make('usuario123'),
            ]
        );
        $usuario->assignRole('usuario');
    }
}
