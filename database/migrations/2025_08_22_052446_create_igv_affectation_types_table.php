<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgvAffectationTypesTable extends Migration
{
    public function up(): void
    {
         Schema::create('igv_affectation_types', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('code', 4)->unique(); // Código SUNAT
            $table->string('description');
            $table->boolean('status')->default(1); // Activo por defecto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('igv_affectation_types');
    }
}

