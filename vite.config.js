import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        
        'resources/css/app.css',
        'resources/css/hero.css',
        'resources/css/contact.css',
        'resources/css/project.css',
        'resources/css/dashboard_project.css',
        'resources/js/app.js',
        'resources/js/project/detail-modal.js',
        'resources/js/project/filters.js',
        'resources/js/three-viewer.js',
        'resources/js/skill-tree.js'
      ],
      refresh: true,
    }),
    tailwindcss(),
  ],
  build: {
    chunkSizeWarningLimit: 1000,
  },
})
