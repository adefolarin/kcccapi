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
        Schema::create('deptmembregs', function (Blueprint $table) {
            $table->bigInteger('deptmembregs_id')->primary();
            $table->text('deptmembuser_name');
            $table->text('deptmembuser_email');
            $table->text('deptmembuser_pnum');
            $table->text('deptmembuser_dept');
            $table->date('deptmembregs_date');
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptmembregs');
    }
};
