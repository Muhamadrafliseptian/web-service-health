<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_produk" => $this->id_produk,
            "nama_produk" => $this->nama_produk,
            "harga_produk" => $this->harga_produk,
            "foto_produk" => $this->foto_produk,
            "deskripsi" => $this->deskripsi
        ];
    }
}
