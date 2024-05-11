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
        Schema::create('followings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id"); // Referencia al usuario que sigue.
            $table->unsignedBigInteger("followed_user_id"); // Referencia al usuario que es seguido.
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("followed_user_id")->references("id")->on("users")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followings');
    }
};
