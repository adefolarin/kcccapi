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
        Schema::table('livecountdowns', function (Blueprint $table) {
            if (Schema::hasTable('livecountdowns')){
                $table->renameColumn('livecountdows_id', 'livecountdowns_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livecountdowns', function (Blueprint $table) {
            //
        });
    }
};
