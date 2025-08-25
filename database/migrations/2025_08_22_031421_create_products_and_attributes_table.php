<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAndAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('code', 100);
            $table->string('barcode')->nullable();
            $table->text('description')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->decimal('igv_rate', 5, 2);
            $table->string('igv_affectation_code', 50);
            $table->integer('stock');
            $table->integer('minimum_stock');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('units_measure_id')->nullable();
            $table->integer('status');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('set null');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
            $table->foreign('units_measure_id')->references('id')->on('units_of_measure')->onDelete('set null');
            // Agrega las demás claves foráneas si las tablas existen
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->text('value');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('category_attributes')->onDelete('cascade');
            $table->unique(['product_id', 'attribute_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('products');
    }
}
