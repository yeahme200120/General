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
        Schema::create('register_sesions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->string('ip');
            $table->string('Latitud');
            $table->string('longitud');
            $table->string('pais');
            $table->string('estado');
            $table->string('ciudad');
            $table->string('cp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_sesions');
    }
};
