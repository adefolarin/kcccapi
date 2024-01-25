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
        Schema::table('deptmembregs', function (Blueprint $table) {
            if (Schema::hasTable('deptmembregs')){
                $table->renameColumn('deptmembuser_name', 'deptmembregs_name');
                $table->renameColumn('deptmembuser_email', 'deptmembregs_email');
                $table->renameColumn('deptmembuser_pnum', 'deptmembregs_pnum');
                $table->renameColumn('deptmembuser_dept', 'deptmembregs_dept');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deptmembregs', function (Blueprint $table) {

        });
    }
};
