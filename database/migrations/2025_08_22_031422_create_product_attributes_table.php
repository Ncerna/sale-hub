<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    public function up()
    {
       /* Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('category_attributes')->onDelete('cascade');
            $table->text('value')->nullable(); // Valor dinámico del atributo (puede ser string, int, etc.)
            $table->integer('status')->default(1);
            $table->timestamps();
        });*/
    }

    public function down()
    {
       // Schema::dropIfExists('product_attributes');
    }
}
