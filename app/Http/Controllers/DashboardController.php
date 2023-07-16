<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Konsumen;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            "konsumen" => Konsumen::count(),
            "artikel" => Artikel::count(),
            "produk" => Produk::count()
        ];

        return response()->json(["jumlah_data" => [$data]]);
    }
}
