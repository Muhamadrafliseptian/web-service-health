<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "artikel";
    public $primaryKey = "id_artikel";

    protected $keyType = "string";

    public $incrementing = false;
}