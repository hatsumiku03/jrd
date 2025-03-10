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
        Schema::create('plataforms', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->bigInteger('height');
            $table->bigInteger('width');
            $table->bigInteger('capacity_kg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plataforms');
    }
};
