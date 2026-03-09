<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillDescriptionSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // ================ FRONTEND =================
            'HTML' => 'Markup language used to structure content on the web.',
            'CSS' => 'Stylesheet language used to style web pages.',
            'JavaScript' => 'Programming language that adds interactivity to web pages.',
            'TypeScript' => 'Superset of JavaScript that adds static types.',
            'Tailwind' => 'Utility-first CSS framework for rapid UI development.',
            'Tailwind CSS' => 'Utility-first CSS framework for modern UI styling.',
            'Bootstrap' => 'Popular CSS framework for responsive design.',
            'React' => 'JavaScript library for building user interfaces.',
            'Vue.js' => 'Progressive JavaScript framework for building UI.',
            'Alpine.js' => 'Lightweight JavaScript framework for declarative UI interactions.',
            'jQuery' => 'Fast, small, and feature-rich JavaScript library.',
            'SASS' => 'CSS preprocessor that adds variables, nesting, and more.',
            'Vite' => 'Modern frontend build tool for faster development.',

            // ================ BACKEND =================
            'PHP' => 'Server-side scripting language for web development.',
            'Laravel' => 'PHP framework for building modern web applications.',
            'Node.js' => 'JavaScript runtime for server-side applications.',
            'Express.js' => 'Minimal web framework for Node.js.',
            'Python' => 'General-purpose programming language widely used in web backend and AI.',
            'Django' => 'High-level Python web framework for rapid development.',
            'Flask' => 'Lightweight Python web framework.',
            'REST API' => 'Architectural style for designing networked applications.',
            'GraphQL' => 'Query language for APIs and a runtime for fulfilling those queries.',
            'MySQL' => 'Open-source relational database management system.',
            'PostgreSQL' => 'Advanced open-source relational database system.',
            'MongoDB' => 'NoSQL database that stores data in JSON-like documents.',
            'SQLite' => 'Lightweight, file-based relational database.',
            'OpenCV' => 'Open-source library for computer vision and image processing.',
            'Tesseract OCR' => 'Optical Character Recognition engine to extract text from images.',

            // ================ TOOLS =================
            'Git' => 'Version control system for tracking code changes.',
            'GitHub' => 'Platform for hosting and collaborating on Git repositories.',
            'GitLab' => 'Git repository manager providing CI/CD features.',
            'Docker' => 'Containerization platform for developing, shipping, and running apps.',
            'Postman' => 'Tool for testing and interacting with APIs.',
            'Insomnia' => 'API client for testing REST and GraphQL endpoints.',
            'NPM' => 'Node.js package manager for installing JavaScript libraries.',
            'Composer' => 'Dependency manager for PHP.',
            'Webpack' => 'Module bundler for JavaScript applications.',
            'Vercel' => 'Cloud platform for hosting frontend frameworks and static sites.',
            'Netlify' => 'Web hosting and automation platform for modern web projects.',
            'Linux' => 'Open-source operating system widely used for servers and development.',
            'Nginx' => 'High-performance web server and reverse proxy server.',
            'Apache' => 'Widely used open-source web server software.',
            'VS Code' => 'Lightweight and powerful code editor.',
            'Figma' => 'Collaborative interface design tool.',
        ];

        foreach ($skills as $name => $description) {
            Skill::where('name', $name)->update(['description' => $description]);
        }
    }
}