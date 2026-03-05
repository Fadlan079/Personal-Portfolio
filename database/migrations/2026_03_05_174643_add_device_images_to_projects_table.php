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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_desktop')->nullable()->after('screenshot');
            $table->string('image_tablet')->nullable()->after('image_desktop');
            $table->string('image_mobile')->nullable()->after('image_tablet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['image_desktop', 'image_tablet', 'image_mobile']);
        });
    }
};
