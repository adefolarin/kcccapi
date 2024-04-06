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
        Schema::table('aamusers', function (Blueprint $table) {
            if (Schema::hasTable('aamusers')){
                $table->text('aamusers_pnum')->nullable();
                $table->text('aamusers_address')->nullable();
                $table->text('aamusers_country')->nullable();
                $table->text('aamusers_state')->nullable();
                $table->text('aamusers_city')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aamusers', function (Blueprint $table) {
            //
        });
    }
};
