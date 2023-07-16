<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            "id_role" => "RO-0001",
            "nama_role" => "administrator"
        ]);

        Role::create([
            "id_role" => "RO-0002",
            "nama_role" => "konsumen"
        ]);
    }
}
