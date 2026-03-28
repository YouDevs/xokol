<?php

use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('index');

route::get('/project', function() {
    return view('project');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
    Route::put('settings/appearance', [Settings\AppearanceController::class, 'update'])->name('settings.appearance.update');

    Route::get('admin/services', [Admin\ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('admin/services/create', [Admin\ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('admin/services', [Admin\ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('admin/services/{service}', [Admin\ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('admin/services/{service}', [Admin\ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('admin/service/{service}', [Admin\ServiceController::class, 'destroy'])->name('admin.services.destroy');

    Route::resource('admin/projects', Admin\ProjectController::class)->names('admin.projects');



});

require __DIR__.'/auth.php';
