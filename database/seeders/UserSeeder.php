<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nama" => "fernando",
            "email" => "fernando@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "081232425925",
            "tempat_lahir" => "bandung",
            "id_role" => "RO-0001",
            "status" => "1", 
        ]);
        User::create([
            "nama" => "agus sofyan",
            "email" => "agus@gmail.com",
            "password" => bcrypt("password"),
            "nomor_hp" => "081232425926",
            "tempat_lahir" => "bandung",
            "id_role" => "RO-0002",
            "status" => "1", 
        ]);
    }
}
