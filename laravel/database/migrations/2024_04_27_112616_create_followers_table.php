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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id"); // Referencia al usuario que es seguido
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("follower_user_id"); // Referencia al usuario que sigue.
            $table->foreign("follower_user_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
