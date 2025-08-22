<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_types');
    }
}

