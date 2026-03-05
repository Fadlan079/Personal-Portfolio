<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->as('dashboard.')
    ->group(function () {
        Route::get('/test', function () {
            return view('pages.test');
        })->name('test');

        Route::get('/', [DashboardController::class, 'index'])
            ->name('home');

        Route::get('/trash', [\App\Http\Controllers\Dashboard\TrashController::class, 'index'])
            ->name('trash');

        Route::post('projects/restore/{id}', [ProjectController::class, 'restore'])
            ->name('projects.restore');

        Route::post('projects/bulk-delete', [ProjectController::class, 'bulkDelete'])
            ->name('bulkDeleteProjects');

        Route::post('projects/bulk-publish', [ProjectController::class, 'bulkPublish'])
            ->name('bulkPublishProjects');

        Route::delete('projects/force-delete/{id}', [ProjectController::class, 'forceDelete'])
            ->name('projects.forceDelete');

        Route::post(
            'projects/bulk-restore',
            [ProjectController::class, 'bulkRestore']
        )
            ->name('bulkRestore');

        Route::post(
            'projects/bulk-force-delete',
            [ProjectController::class, 'bulkForceDelete']
        )
            ->name('bulkForceDelete');

        Route::post('skills/restore/{id}', [\App\Http\Controllers\Dashboard\TrashController::class, 'restoreSkill'])
            ->name('skills.restore');

        Route::delete('skills/force-delete/{id}', [\App\Http\Controllers\Dashboard\TrashController::class, 'forceDeleteSkill'])
            ->name('skills.forceDelete');

        Route::post('skills/bulk-restore', [\App\Http\Controllers\Dashboard\TrashController::class, 'bulkRestoreSkills'])
            ->name('skills.bulkRestore');

        Route::post('skills/bulk-force-delete', [\App\Http\Controllers\Dashboard\TrashController::class, 'bulkForceDeleteSkills'])
            ->name('skills.bulkForceDelete');

        Route::get('account', [ProfileController::class, 'edit'])
            ->name('account.edit');

        Route::patch('account', [ProfileController::class, 'update'])
            ->name('account.update');

        Route::delete('account', [ProfileController::class, 'destroy'])
            ->name('account.destroy');

        Route::get('/settings', [\App\Http\Controllers\Dashboard\SettingsController::class, 'index'])->name('settings');
        Route::put('/settings', [\App\Http\Controllers\Dashboard\SettingsController::class, 'update'])->name('settings.update');

        Route::resource('projects', ProjectController::class)->except(['show']);
        Route::resource('skills', \App\Http\Controllers\Dashboard\SkillController::class)->except(['show']);
    });

require __DIR__ . '/auth.php';

Route::name('portofolio.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'Showabout'])->name('about');
    Route::get('/projects', [HomeController::class, 'Showproject'])->name('projects');
    Route::get('/contact', [HomeController::class, 'Showcontact'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
    Route::view('/test', 'pages.tes')->name('test');
});

Route::get('/api/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    app()->setLocale($locale);

    return response()->json(
        trans()->get('*')
    )->withCookie(
        cookie('locale', $locale, 60 * 24 * 365)
    );
});

Route::post('/api/theme', function (Illuminate\Http\Request $request) {
    if ($user = $request->user()) {
        $validated = $request->validate([
            'theme' => ['required', 'string', 'in:light,dark,system'],
        ]);
        /** @var \App\Models\User $user */
        $user->update(['theme' => $validated['theme']]);
    }
    return response()->json(['success' => true]);
});

Route::post('/api/locale', function (Illuminate\Http\Request $request) {
    if ($user = $request->user()) {
        $validated = $request->validate([
            'locale' => ['required', 'string', 'in:en,id'],
        ]);
        /** @var \App\Models\User $user */
        $user->update(['locale' => $validated['locale']]);
    }
    return response()->json(['success' => true]);
});
