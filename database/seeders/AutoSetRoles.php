<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutoSetRoles extends Seeder
{
    public function run(): void
    {
        Rol::insert([
            ["type" => 'Usuario'],
            ["type" => 'Administrador'],
            ["type" => 'Vendedor']
        ]);
    }
}
