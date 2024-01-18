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
        Schema::create('volforms', function (Blueprint $table) {
            $table->bigInteger('volforms_id')->primary();
            $table->bigInteger('volcategoriesid')->primary();
            $table->dateTime('voldatetime');
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volforms');
    }
};
