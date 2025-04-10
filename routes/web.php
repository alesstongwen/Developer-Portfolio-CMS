<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);

    Route::get('/dashboard', function () {
        return redirect()->route('projects.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/test-view', function () {
    return view('projects.index', ['projects' => []]);
});

// Add this to a temporary route to check your PHP settings
Route::get('/phpinfo', function() {
    echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . '<br>';
    echo 'post_max_size: ' . ini_get('post_max_size') . '<br>';
    echo 'memory_limit: ' . ini_get('memory_limit') . '<br>';
    echo 'max_file_uploads: ' . ini_get('max_file_uploads') . '<br>';
    echo 'temp directory: ' . sys_get_temp_dir() . '<br>';
});

require __DIR__.'/auth.php';
