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
                $table->text('aamusers_code')->nullable();
                $table->datetime('aamusers_resetdate')->nullable();
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
