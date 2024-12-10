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
        Schema::create('user_crews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crews_id')->constrained(
                table: 'crews', indexName: 'crewsUserCrew_id'
            )->onDelete('cascade');
            $table->foreignId('users_id')->constrained(
                table: 'users', indexName: 'usersUserCrew_id'
            )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_crews');
    }
};
