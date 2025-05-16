<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
                'descripcion' => 'Acceso total al sistema',
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Empleado',
                'descripcion' => 'Acceso limitado a ciertas áreas',
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Conductor',
                'descripcion' => 'Acceso a tareas específicas relacionadas con transporte',
                'status' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
