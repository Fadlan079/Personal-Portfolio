<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = \App\Models\Skill::all();

        foreach ($skills as $skill) {
            $desc = match(strtolower($skill->name)) {
                'laravel' => 'Framework PHP populer yang elegan dan ekspresif untuk backend web.',
                'php' => 'Bahasa scripting server-side utama untuk pengembangan web dinamis.',
                'javascript', 'js' => 'Bahasa pemrograman inti untuk interaktivitas di sisi klien web.',
                'react' => 'Library JavaScript deklaratif untuk membangun antarmuka pengguna (UI).',
                'vue', 'vuejs', 'vue.js' => 'Framework JavaScript progresif yang mudah dipelajari untuk UI.',
                'tailwind', 'tailwindcss' => 'Framework CSS utility-first untuk styling yang cepat dan konsisten.',
                'bootstrap' => 'Framework CSS klasik untuk membuat layout responsif dengan cepat.',
                'mysql' => 'Sistem manajemen basis data relasional (RDBMS) sumber terbuka.',
                'git' => 'Sistem pengontrol versi didistribusikan untuk pelacakan kode.',
                'html' => 'Bahasa markah standar untuk struktur halaman web.',
                'css' => 'Bahasa stylesheet untuk mendesain tampilan halaman web.',
                'livewire' => 'Framework full-stack untuk Laravel yang membuat antarmuka dinamis.',
                'alpine', 'alpinejs', 'alpine.js' => 'Framework JavaScript minimalis untuk menambah behavior di HTML.',
                default => 'Teknologi dalam tumpukan pengembangan.'
            };

            $skill->update(['description' => $desc]);
        }
    }
}
