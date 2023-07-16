<?php

namespace Database\Seeders;

use App\Models\Konsumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Konsumen::create([
            "id_konsumen" => "KSN-0001",
            "user_id" => 2,
            "nik" => "1221352"
        ]);
    }
}
