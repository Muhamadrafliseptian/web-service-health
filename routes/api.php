<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\produk\ProdukController;
use App\Http\Controllers\api\artikel\ArtikelController;
use App\Http\Controllers\api\artikel\DetailArtikelController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("artikel/{slug}", [DetailArtikelController::class, "index"]);
Route::resource("artikel", ArtikelController::class);
Route::resource("produk", ProdukController::class);
