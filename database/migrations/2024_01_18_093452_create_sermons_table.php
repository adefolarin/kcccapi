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
        if(!Schema::hasTable('sermons')) {
        Schema::create('sermons', function (Blueprint $table) {
            $table->bigInteger('sermons_id')->primary();
            $table->bigInteger('sermoncategoriesid');
            $table->text('sermons_title');
            $table->text('sermons_file');
            $table->date('sermons_date');
            $table->text('sermons_location')->nullable(true);
            $table->text('sermons_preacher')->nullable(true);
            $table->text('sermons_likes')->nullable(true);
            $table->text('sermons_shares')->nullable(true);
            $table->timestamps();
        });
      }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
