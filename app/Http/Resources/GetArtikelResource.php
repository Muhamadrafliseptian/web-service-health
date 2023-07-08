<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetArtikelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_artikel" => $this->id_artikel,
            "judul_artikel" => $this->judul_artikel,
            "slug_artikel" => $this->slug_artikel,
            "foto" => $this->foto,
            "deskripsi" => $this->deskripsi
        ];
    }
}
