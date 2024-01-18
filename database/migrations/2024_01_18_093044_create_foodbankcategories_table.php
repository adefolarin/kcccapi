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
        Schema::create('foodbankcategories', function (Blueprint $table) {
            $table->bigInteger('foodbankcategories_id')->primary();
            $table->text('foodbankcategories_name');
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodbankcategories');
    }
};
