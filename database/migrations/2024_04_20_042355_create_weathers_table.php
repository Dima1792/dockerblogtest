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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('nameCity')->unique();
            $table->json('current_units');
            $table->json('current');
            $table->json('hourly_units');
            $table->json('hourly');
            $table->json('daily_units');
            $table->json('daily');
            $table->unique(['date','nameCity']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
