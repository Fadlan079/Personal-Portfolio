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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['theme', 'locale', 'show_clock', 'clock_format']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('theme', ['light', 'dark', 'system'])->default('system');
            $table->enum('locale', ['en', 'id'])->default('en');
            $table->boolean('show_clock')->default(true);
            $table->enum('clock_format', ['12', '24'])->default('24');
        });
    }
};
