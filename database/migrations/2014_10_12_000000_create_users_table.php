<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 100);
            $table->string("email", 100)->nullable()->unique();
            $table->string("password");
            $table->string("nomor_hp", 20);
            $table->string("tempat_lahir", 50)->nullable();
            $table->string("id_role", 50);
            $table->enum("status", [1, 0]);
            $table->string("token")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
