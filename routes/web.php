<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ProjectController;

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->as('dashboard.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('home');

        Route::get('projects/trash', [ProjectController::class, 'trash'])
            ->name('trash');

        Route::post('projects/restore/{id}', [ProjectController::class, 'restore'])
            ->name('projects.restore');

        Route::delete('projects/force-delete/{id}', [ProjectController::class, 'forceDelete'])
            ->name('projects.forceDelete');
        Route::post('projects/bulk-restore',
            [ProjectController::class, 'bulkRestore'])
            ->name('bulkRestore');

        Route::post('projects/bulk-force-delete',
            [ProjectController::class, 'bulkForceDelete'])
            ->name('bulkForceDelete');

        Route::resource('projects', ProjectController::class)->except(['show']);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::name('portofolio.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'Showabout'])->name('about');
    Route::get('/project', [HomeController::class, 'Showproject'])->name('project');
    Route::get('/contact', [HomeController::class, 'Showcontact'])->name('contact');
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
