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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->bigInteger('podcasts_id')->primary();
            $table->bigInteger('podcastcategoriesid')->primary();
            $table->text('podcast_title');
            $table->text('podcast_file');
            $table->date('podcast_date');
            $table->text('podcast_location')->nullable(true);
            $table->text('podcast_preacher')->nullable(true);
            $table->text('podcast_likes')->nullable(true);
            $table->text('podcast_shares')->nullable(true);
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
