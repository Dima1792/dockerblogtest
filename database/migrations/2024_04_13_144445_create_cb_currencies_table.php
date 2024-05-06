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
        Schema::create('cb_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('valute',10);
            $table->string('name',100);
            $table->string('value');
            $table->string('previous');
            $table->unique([ 'valute','date']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cb_currencies');
    }
};
