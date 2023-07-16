<?php

use App\Http\Controllers\api\akun\KonsumenController;
use App\Http\Controllers\api\akun\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\produk\ProdukController;
use App\Http\Controllers\api\artikel\ArtikelController;
use App\Http\Controllers\api\autentikasi\LoginController;
use App\Http\Controllers\api\artikel\DetailArtikelController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

require __DIR__ . '/auth/login.php';

Route::get("artikel/{slug}", [DetailArtikelController::class, "index"]);
Route::get("count_data", [DashboardController::class, "index"]);

Route::middleware("auth:sanctum")->group(function(){
    Route::resource("artikel", ArtikelController::class);
    Route::resource("produk", ProdukController::class);
    Route::resource("role", RoleController::class);
    Route::resource("konsumen", KonsumenController::class);
});

Route::get("/logout", [LoginController::class, "logout"]);