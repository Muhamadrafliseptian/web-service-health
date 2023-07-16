<?php

namespace App\Http\Controllers\api\akun;

use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetKonsumenResource;

class KonsumenController extends Controller
{
    public function index(Request $request){
        return DB::transaction(function () use($request) {
            $konsumen = Konsumen::orderBy("created_at", "DESC")->paginate($request->per_page);
            
            return GetKonsumenResource::collection($konsumen);
        });
    }
    public function edit($id_konsumen)
    {
        return DB::transaction(function () use ($id_konsumen) {
            $konsumen = Konsumen::where("id_konsumen", $id_konsumen)->first();

            return new GetKonsumenResource($konsumen);
        });
    }
}
