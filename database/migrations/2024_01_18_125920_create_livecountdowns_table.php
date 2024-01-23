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
        if(!Schema::hasTable('livecountdowns')) {
        Schema::create('livecountdowns', function (Blueprint $table) {
            $table->bigInteger('livecountdows_id')->autoIncrement();
            $table->dateTime('livecountdowns_datetime');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livecountdowns');
    }
};
