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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre_empresa");
            $table->string("representante_empresa");
            $table->string("email_empresa");
            $table->string("rfc_empresa");
            $table->string("direccion_empresa");
            $table->string("telefono_empresa");
            $table->date("fecha_registro");
            $table->date("limite_vigencia");
            $table->integer("estatus_empresa");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
