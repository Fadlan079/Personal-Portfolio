<?php

// Polyfill for missing PHP fileinfo extension
if (!class_exists('finfo')) {
    if (!defined('FILEINFO_MIME_TYPE')) {
        define('FILEINFO_MIME_TYPE', 16);
    }

    class finfo {
        public function __construct(int $flags = 0, ?string $magic_database = null) {
            // No-op
        }

        public function file(string $filename, int $flags = 0, $context = null): string|false {
            if (!is_file($filename)) {
                return false;
            }
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            return self::getMimeTypeFromExtension($extension) ?: 'application/octet-stream';
        }

        public function buffer(string $string, int $flags = 0, $context = null): string|false {
            // Check common magic bytes
            if (str_starts_with($string, "\xff\xd8\xff")) {
                return 'image/jpeg';
            }
            if (str_starts_with($string, "\x89PNG\r\n\x1a\n")) {
                return 'image/png';
            }
            if (str_starts_with($string, "GIF87a") || str_starts_with($string, "GIF89a")) {
                return 'image/gif';
            }
            if (str_starts_with($string, "RIFF") && substr($string, 8, 4) === "WEBP") {
                return 'image/webp';
            }
            if (str_starts_with($string, "%PDF")) {
                return 'application/pdf';
            }

            return 'application/octet-stream';
        }

        private static function getMimeTypeFromExtension(string $extension): ?string {
            $map = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'webp' => 'image/webp',
                'pdf' => 'application/pdf',
                'svg' => 'image/svg+xml',
                'zip' => 'application/zip',
                'txt' => 'text/plain',
                'html' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'mp4' => 'video/mp4',
                'mp3' => 'audio/mpeg',
                'wav' => 'audio/wav',
            ];
            return $map[$extension] ?? null;
        }
    }
}

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');

        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\SetUserLocale::class,
        ]);

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminOnly::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:auto-force-delete-trashed-projects')
            ->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
