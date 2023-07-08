<?php

namespace App\Http\Controllers\api\produk;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\GetProdukResource;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $produk = Produk::orderBy("created_at", "DESC")->paginate($request->per_page);
            return GetProdukResource::collection($produk);
        });
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'foto_produk' => 'required|image',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['pesan' => 'Semua kolom wajib diisi'], 400);
        }

        return DB::transaction(function () use ($request) {
            if ($request->hasFile("foto_produk")) {
                $data = $request->file("foto_produk")->store("produk");
            }

            Produk::create([
                "id_produk" => "PR-" . date("YmdHis"),
                "nama_produk" => $request->nama_produk,
                "harga_produk" => $request->harga_produk,
                "foto_produk" => url("storage/" . $data),
                "deskripsi" => $request->deskripsi,
            ]);

            return response()->json(["pesan" => "Data Produk Berhasil ditambahkan"]);
        });
    }


    public function edit($id_produk)
    {
        return DB::transaction(function () use ($id_produk) {
            $produk = Produk::where("id_produk", $id_produk)->first();

            return new GetProdukResource($produk);
        });
    }
    public function update(Request $request, $id_produk)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'foto_produk' => 'required|image',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['pesan' => 'Semua kolom wajib diisi'], 400);
        }
        return DB::transaction(function () use ($id_produk, $request) {

            if ($request->file("foto_produk")) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $nama_gambar = $request->file("foto_produk")->store("produk");

                $data = url("/storage/" . $nama_gambar);
            } else {
                $data = url('') . '/storage/' . $request->gambarLama;
            }

            Produk::where("id_produk", $id_produk)->update([
                "nama_produk" => $request->nama_produk,
                "harga_produk" => $request->harga_produk,
                "foto_produk" => $data,
                "deskripsi" => $request->deskripsi,
            ]);

            return response()->json(["pesan" => "Data Produk Berhasil Diubah"]);
        });
    }
    public function destroy($id_produk)
    {
        return DB::transaction(function () use ($id_produk) {

            $produk = Produk::where("id_produk", $id_produk)->first();

            $data = str_replace(url('storage/'), "", $produk->foto_produk);
            Storage::delete($data);

            $produk->delete();

            return response()->json(["pesan" => "Data Produk Berhasil dihapus"]);
        });
    }
}
