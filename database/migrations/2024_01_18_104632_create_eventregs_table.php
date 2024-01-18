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
        Schema::create('eventregs', function (Blueprint $table) {
            $table->bigInteger('eventregs_id')->primary();
            $table->text('enventuser_name');
            $table->text('enventuser_email');
            $table->text('enventuser_pnum');
            $table->text('enventuser_event');
            $table->date('enventregs_date');
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventregs');
    }
};
