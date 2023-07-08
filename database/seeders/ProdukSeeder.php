<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            "id_produk" => "PR-12345",
            "nama_produk" => "bodrex",
            "harga_produk" => "20000",
            "deskripsi" => "pereda pusing"
        ]);
    }
}
