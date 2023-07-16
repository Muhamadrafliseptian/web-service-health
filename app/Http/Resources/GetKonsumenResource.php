<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetKonsumenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_konsumen" => $this->id_konsumen,
            "nik" => $this->nik,
            "user" => $this->getUsers,
        ];
    }
}
