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
        Schema::table('eventregs', function (Blueprint $table) {
            if (Schema::hasTable('eventregs')){
                $table->renameColumn('enventuser_name', 'eventregs_name');
                $table->renameColumn('enventuser_email', 'eventregs_email');
                $table->renameColumn('enventuser_pnum', 'eventregs_pnum');
                $table->renameColumn('enventuser_event', 'eventregs_event');
                $table->renameColumn('eventregs_date', 'eventregs_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventregs', function (Blueprint $table) {

        });
    }
};
