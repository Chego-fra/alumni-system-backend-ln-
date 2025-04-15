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
        Schema::create('r_s_v_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('alumni_id')->constrained('alumni_profiles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_s_v_p_s');
    }
};
