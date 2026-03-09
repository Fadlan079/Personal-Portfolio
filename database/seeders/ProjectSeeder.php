<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $types = ['Website','Web App','Application','Design'];
        $statuses = ['Shipped','In Progress','Prototype','Archived'];
        $visibilities = ['draft','public'];
        $skills = [
            'HTML','CSS','JavaScript','TypeScript','Tailwind','Bootstrap',
            'React','Vue.js','Alpine.js','Laravel','PHP','Node.js','Express.js','Python','Django','Flask','MySQL','PostgreSQL','MongoDB','OpenCV','Tesseract OCR','Git','Docker','VS Code'
        ];

        for ($i = 1; $i <= 20; $i++) {
            $techCount = rand(3,6);
            shuffle($skills);
            $techSelected = array_slice($skills, 0, $techCount);

            Project::create([
                'title' => "Dummy $i",
                'type' => $types[array_rand($types)],
                'desc' => "This is a description for Dummy $i project.",
                'role' => $faker->jobTitle,
                'team_size' => rand(1,10) . " members",
                'responsibilities' => "Responsible for " . implode(", ", $techSelected),
                'status' => $statuses[array_rand($statuses)],
                'visibility' => $visibilities[array_rand($visibilities)],
                'published_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'tech' => null, // kosong dulu
                'repo' => "https://github.com/dummy/project-$i",
                'live_url' => "https://dummy-project-$i.example.com",
                'screenshot' => json_encode([
                    "desktop" => "https://via.placeholder.com/1200x800?text=Dummy+$i+Desktop",
                    "tablet" => "https://via.placeholder.com/800x600?text=Dummy+$i+Tablet",
                    "mobile" => "https://via.placeholder.com/400x800?text=Dummy+$i+Mobile",
                ]),
                'image_desktop' => "https://via.placeholder.com/1200x800?text=Dummy+$i+Desktop",
                'image_tablet' => "https://via.placeholder.com/800x600?text=Dummy+$i+Tablet",
                'image_mobile' => "https://via.placeholder.com/400x800?text=Dummy+$i+Mobile",
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}