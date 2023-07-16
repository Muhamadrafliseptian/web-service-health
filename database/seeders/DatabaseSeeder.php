<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProdukSeeder;
use Database\Seeders\ArtikelSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProdukSeeder::class);
        $this->call(ArtikelSeeder::class);
        $this->call(KonsumenSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
