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
        if(!Schema::hasTable('aamusers')) {
            Schema::create('aamusers', function (Blueprint $table) {
                $table->bigInteger('aamusers_id')->autoIncrement();
                $table->string('aamusers_name');
                $table->string('aamusers_email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('aamusers_password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aamusers');
    }
};
