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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->enum("visibility", ["global", "user"]);
            $table->string("name");
            $table->integer("calories");
            $table->integer("size_portion_g");
            $table->integer("total_fat_g");
            $table->integer("saturated_fat_g");
            $table->integer("protein_g");
            $table->integer("sodium_mg");
            $table->integer("potassium_mg");
            $table->integer("carbohydrate_total_g");
            $table->integer("fiber_g");
            $table->integer("sugar_g");
            $table->string("extra_info")->nullable();
            $table->longText("image")->nullable();
            $table->enum('suggestion', [
                'yes',
                'no'
            ])->nullable();
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
