
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->integer('status')->default(1);
            $table->string('path_photo')->nullable();
            $table->string('path_qr')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}




