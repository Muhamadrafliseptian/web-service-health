<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artikel::create([
            "id_artikel" => "ART-12345",
            "judul_artikel" => "maag kambuh",
            "deskripsi" => "minum obat",
            "slug_artikel" => "maag-kambuh"
        ]);
    }
}
