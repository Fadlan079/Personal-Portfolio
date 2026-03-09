<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [

            // ================= FRONTEND =================

            ['name'=>'HTML','category'=>'frontend','icon'=>'<i class="fa-brands fa-html5"></i>'],
            ['name'=>'CSS','category'=>'frontend','icon'=>'<i class="fa-brands fa-css3-alt"></i>'],
            ['name'=>'JavaScript','category'=>'frontend','icon'=>'<i class="fa-brands fa-js"></i>'],
            ['name'=>'TypeScript','category'=>'frontend','icon'=>'<i class="fa-solid fa-code"></i>'],
            ['name'=>'Tailwind CSS','category'=>'frontend','icon'=>'<i class="fa-solid fa-wind"></i>'],
            ['name'=>'Bootstrap','category'=>'frontend','icon'=>'<i class="fa-brands fa-bootstrap"></i>'],
            ['name'=>'React','category'=>'frontend','icon'=>'<i class="fa-brands fa-react"></i>'],
            ['name'=>'Vue.js','category'=>'frontend','icon'=>'<i class="fa-brands fa-vuejs"></i>'],
            ['name'=>'Alpine.js','category'=>'frontend','icon'=>'<i class="fa-solid fa-mountain"></i>'],
            ['name'=>'jQuery','category'=>'frontend','icon'=>'<i class="fa-solid fa-code"></i>'],
            ['name'=>'SASS','category'=>'frontend','icon'=>'<i class="fa-brands fa-sass"></i>'],
            ['name'=>'Vite','category'=>'frontend','icon'=>'<i class="fa-solid fa-bolt"></i>'],

            // ================= BACKEND =================

            ['name'=>'PHP','category'=>'backend','icon'=>'<i class="fa-brands fa-php"></i>'],
            ['name'=>'Laravel','category'=>'backend','icon'=>'<i class="fa-brands fa-laravel"></i>'],
            ['name'=>'Node.js','category'=>'backend','icon'=>'<i class="fa-brands fa-node-js"></i>'],
            ['name'=>'Express.js','category'=>'backend','icon'=>'<i class="fa-solid fa-server"></i>'],
            ['name'=>'Python','category'=>'backend','icon'=>'<i class="fa-brands fa-python"></i>'],
            ['name'=>'Django','category'=>'backend','icon'=>'<i class="fa-solid fa-server"></i>'],
            ['name'=>'Flask','category'=>'backend','icon'=>'<i class="fa-solid fa-server"></i>'],
            ['name'=>'REST API','category'=>'backend','icon'=>'<i class="fa-solid fa-network-wired"></i>'],
            ['name'=>'GraphQL','category'=>'backend','icon'=>'<i class="fa-solid fa-diagram-project"></i>'],

            // DATABASE
            ['name'=>'MySQL','category'=>'backend','icon'=>'<i class="fa-solid fa-database"></i>'],
            ['name'=>'PostgreSQL','category'=>'backend','icon'=>'<i class="fa-solid fa-database"></i>'],
            ['name'=>'MongoDB','category'=>'backend','icon'=>'<i class="fa-solid fa-database"></i>'],
            ['name'=>'SQLite','category'=>'backend','icon'=>'<i class="fa-solid fa-database"></i>'],

            // AI / COMPUTER VISION
            ['name'=>'OpenCV','category'=>'backend','icon'=>'<i class="fa-solid fa-eye"></i>'],
            ['name'=>'Tesseract OCR','category'=>'backend','icon'=>'<i class="fa-solid fa-font"></i>'],

            // ================= TOOLS =================

            ['name'=>'Git','category'=>'tools','icon'=>'<i class="fa-brands fa-git-alt"></i>'],
            ['name'=>'GitHub','category'=>'tools','icon'=>'<i class="fa-brands fa-github"></i>'],
            ['name'=>'GitLab','category'=>'tools','icon'=>'<i class="fa-brands fa-gitlab"></i>'],
            ['name'=>'Docker','category'=>'tools','icon'=>'<i class="fa-brands fa-docker"></i>'],
            ['name'=>'Postman','category'=>'tools','icon'=>'<i class="fa-solid fa-paper-plane"></i>'],
            ['name'=>'Insomnia','category'=>'tools','icon'=>'<i class="fa-solid fa-moon"></i>'],
            ['name'=>'NPM','category'=>'tools','icon'=>'<i class="fa-brands fa-npm"></i>'],
            ['name'=>'Composer','category'=>'tools','icon'=>'<i class="fa-solid fa-cubes"></i>'],
            ['name'=>'Webpack','category'=>'tools','icon'=>'<i class="fa-solid fa-box"></i>'],
            ['name'=>'Vercel','category'=>'tools','icon'=>'<i class="fa-solid fa-cloud"></i>'],
            ['name'=>'Netlify','category'=>'tools','icon'=>'<i class="fa-solid fa-cloud"></i>'],
            ['name'=>'Linux','category'=>'tools','icon'=>'<i class="fa-brands fa-linux"></i>'],
            ['name'=>'Nginx','category'=>'tools','icon'=>'<i class="fa-solid fa-server"></i>'],
            ['name'=>'Apache','category'=>'tools','icon'=>'<i class="fa-solid fa-server"></i>'],
            ['name'=>'VS Code','category'=>'tools','icon'=>'<i class="fa-solid fa-code"></i>'],
            ['name'=>'Figma','category'=>'tools','icon'=>'<i class="fa-brands fa-figma"></i>'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                [
                    'category' => $skill['category'],
                    'icon' => $skill['icon'],
                    'description' => null
                ]
            );
        }
    }
}