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
        Schema::table('foodbanks', function (Blueprint $table) {
            if (Schema::hasTable('foodbanks')){
                $table->text('foodbanks_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foodbanks', function (Blueprint $table) {
            //
        });
    }
};
