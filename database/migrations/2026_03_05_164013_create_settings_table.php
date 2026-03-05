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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('theme', ['light', 'dark', 'system'])->default('system');
            $table->enum('locale', ['en', 'id'])->default('en');
            $table->boolean('show_clock')->default(true);
            $table->enum('clock_format', ['12', '24'])->default('24');
            $table->boolean('show_seconds')->default(true);
            $table->boolean('show_date')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
