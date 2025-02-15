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
        Schema::create('index_pages', function (Blueprint $table) {
            $table->id();

            $table->string('url');
            $table->dateTime('last_checked_at')->nullable();
            $table->integer('status_code')->nullable();
            $table->string('error_message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('index_pages');
    }
};
