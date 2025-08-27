<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
 

public function run(): void
{
    $roles = ['admin', 'vendedor', 'almacenero'];

    foreach ($roles as $role) {
        DB::table('roles')->updateOrInsert(
            ['role_name' => $role],
            ['updated_at' => now(), 'created_at' => now()]
        );
    }
}

    }

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();

            // Relaciones
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');

            $table->unsignedBigInteger('sede_id')->nullable();
            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('set null');

            $table->tinyInteger('status')->default(1); // 1 = activo, 0 = inactivo
            $table->string('path_photo')->nullable();
            $table->string('path_qr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
