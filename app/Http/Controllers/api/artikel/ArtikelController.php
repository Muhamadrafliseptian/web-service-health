<?php

namespace App\Http\Controllers\api\artikel;

use App\Models\Artikel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\GetArtikelResource;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $artikel = Artikel::orderBy("created_at", "DESC")->paginate($request->per_page);

            return GetArtikelResource::collection($artikel);
        });
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_artikel' => 'required',
            'foto' => 'required|image',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['pesan' => 'Semua kolom wajib diisi'], 400);
        }

        return DB::transaction(function () use ($request) {
            if ($request->file("foto")) {
                $data = $request->file("foto")->store("artikel");
            }

            Artikel::create([
                "id_artikel" => "ART-" . date("YmdHis"),
                "judul_artikel" => $request->judul_artikel,
                "slug_artikel" => Str::slug($request->judul_artikel),
                "foto" => url("storage/" . $data),
                "deskripsi" => $request->deskripsi,
            ]);

            return response()->json(["pesan" => "Data Artikel Berhasil ditambahkan"]);
        });
    }

    public function edit($id_artikel)
    {
        return DB::transaction(function () use ($id_artikel) {
            $artikel = Artikel::where("id_artikel", $id_artikel)->first();

            return new GetArtikelResource($artikel);
        });
    }

    public function update(Request $request, $id_artikel)
    {
        $validator = Validator::make($request->all(), [
            'judul_artikel' => 'required',
            'foto' => 'required|image',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['pesan' => 'Semua kolom wajib diisi'], 400);
        }

        return DB::transaction(function () use ($id_artikel, $request) {

            if ($request->file("foto")) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $nama_gambar = $request->file("foto")->store("artikel");

                $data = url("/storage/" . $nama_gambar);
            } else {
                $data = url('') . '/storage/' . $request->gambarLama;
            }

            Artikel::where("id_artikel", $id_artikel)->update([
                "judul_artikel" => $request->judul_artikel,
                "slug_artikel" => Str::slug($request->judul_artikel),
                "foto" => $data,
                "deskripsi" => $request->deskripsi,
            ]);

            return response()->json(["pesan" => "Data Artikel Berhasil Diubah"]);
        });
    }

    public function destroy($id_artikel)
    {
        return DB::transaction(function () use ($id_artikel) {

            $artikel = Artikel::where("id_artikel", $id_artikel)->first();

            $data = str_replace(url('storage/'), "", $artikel->foto);
            Storage::delete($data);

            $artikel->delete();

            return response()->json(["pesan" => "Data Artikel Berhasil dihapus"]);
        });
    }
}
