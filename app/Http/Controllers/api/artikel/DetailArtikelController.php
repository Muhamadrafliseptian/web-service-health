<?php

namespace App\Http\Controllers\api\artikel;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetArtikelResource;

class DetailArtikelController extends Controller
{
    public function index($slug)
    {
        return DB::transaction(function () use ($slug) {
            $artikel = Artikel::where("slug_artikel", $slug)->first();
            return new GetArtikelResource($artikel);
        });
    }
}
