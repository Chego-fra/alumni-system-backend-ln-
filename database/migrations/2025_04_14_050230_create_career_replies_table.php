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
        Schema::create('career_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained('careers')->onDelete('cascade');
            $table->foreignId('alumni_id')->constrained('alumni_profiles')->onDelete('cascade');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_replies');
    }
};
