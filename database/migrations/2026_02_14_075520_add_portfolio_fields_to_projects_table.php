<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('role')->nullable()->after('desc');
            $table->string('team_size')->nullable()->after('role');
            $table->string('live_url')->nullable()->after('repo');
            $table->text('responsibilities')->nullable()->after('team_size');
            $table->string('screenshot')->nullable()->after('live_url');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropColumn([
                'role',
                'team_size',
                'live_url',
                'responsibilities',
                'screenshot'
            ]);

        });
    }
};
