<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan 'Finished' ke enum list sementara
        DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('Shipped', 'In Progress', 'Prototype', 'Archived', 'Finished') DEFAULT 'Prototype'");

        // 2. Pindahkan data lama ke values yang baru ('Finished')
        DB::table('projects')->whereIn('status', ['Shipped', 'Archived'])->update(['status' => 'Finished']);

        // 3. Ubah enum column untuk membuang status yang tidak dipakai
        DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('Prototype', 'In Progress', 'Finished') DEFAULT 'Prototype'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambahkan enum list sementara
        DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('Shipped', 'In Progress', 'Prototype', 'Archived', 'Finished') DEFAULT 'Prototype'");
        
        // Kembalikan ke format sebelumnya
        DB::table('projects')->where('status', 'Finished')->update(['status' => 'Shipped']);
        
        // Kembalikan ke enum asli
        DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('Shipped', 'In Progress', 'Prototype', 'Archived') DEFAULT 'Prototype'");
    }
};
