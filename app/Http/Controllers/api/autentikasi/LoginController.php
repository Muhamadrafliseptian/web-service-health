<?php

namespace App\Http\Controllers\api\autentikasi;

use App\Models\User;
use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\autentikasi\ValidatorLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(ValidatorLogin $request)
    {

        $user = User::where("nomor_hp", $request->nomor_hp)->first();

        if (!$user) {
            return response()->json(
                ["pesan" => "Akun Tidak Terdaftar"],
                404
            );
        }

        if ($user->status != "1") {
            return response()->json(
                ["pesan" => "Status Akun Tidak Aktif"],
                404
            );
        }

        $cekPassword = Hash::check($request->password, $user->password);

        if (!$cekPassword) {
            return response()->json(
                ["pesan" => "Maaf, Password Salah"],
                404
            );
        }

        $token = $user->createToken("api", [$user->getRole->nama_role]);

        Auth::login($user);

        $user['token'] = $token->plainTextToken;

        return response()->json(["message" => "Berhasil Login",  "data" => $user]);
    }
    public function register(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::create([
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "nomor_hp" => $request->nomor_hp,
                "id_role" => "RO-0002",
                "status" =>  1
            ]);

            Konsumen::create([
                "id_konsumen" => "KSN-" . date("YmdHis"),
                "user_id" => $user->id,
                "nik" => $request->nik
            ]);

            return response()->json(["pesan" => "Berhasil registrasi akun", "user" => $user["id"]]);
        });
    }
}
