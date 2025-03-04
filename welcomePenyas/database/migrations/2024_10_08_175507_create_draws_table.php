<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /* Esto esta mal, tiene que quedarse un registro de otros años */
    public function up(): void
    {
        Schema::create('draws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crew_id')->constrained(
                table: 'crews', indexName: 'crewsDraws_id'
            )->cascadeOnDelete();
            $table->foreignId('location_id')->constrained(
                table: 'locations', indexName: 'locationDraws_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draws');
    }
};
