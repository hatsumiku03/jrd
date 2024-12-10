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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('import');
            $table->boolean('status');
            $table->foreignId('user_crews_id')->constrained(
                table: 'user_crews', indexName: 'user_crews_id'
            );
            $table->foreignId('crews_id')->constrained(
                table: 'crews', indexName: 'crewsPayments_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
