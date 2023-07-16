<?php

use App\Http\Controllers\API\autentikasi\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix("autentikasi")->group(function () {
    Route::post("/login", [LoginController::class, "login"]);
    Route::get("/login", function () {
        return response()->json([
            "pesan" => "Anda Harus Login Terlebih Dahulu",
            "status" => 401
        ]);
    })->name("login");
    Route::post("/register", [LoginController::class, "register"]);
});
