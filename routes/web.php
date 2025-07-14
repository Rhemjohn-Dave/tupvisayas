<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/programs', 'pages.programs')->name('programs');
Route::view('/admissions', 'pages.admissions')->name('admissions');
Route::view('/facilities', 'pages.facilities')->name('facilities');
Route::view('/student-services', 'pages.student_services')->name('student_services');
Route::get('/officials', [App\Http\Controllers\OfficialController::class, 'index'])->name('officials');
Route::get('/officials/{id}', [App\Http\Controllers\OfficialController::class, 'show'])->name('officials.show');
Route::get('/news-events', [App\Http\Controllers\NewsController::class, 'index'])->name('news_events');
Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements');
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/news/{id}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/jobs/{id}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
Route::get('/events/{id}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('dashboard');
    Route::get('posts/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('posts.store');
    Route::resource('news', App\Http\Controllers\NewsController::class);
    Route::resource('announcements', App\Http\Controllers\AnnouncementController::class);
    Route::resource('jobs', App\Http\Controllers\JobController::class);
    Route::resource('events', App\Http\Controllers\EventController::class);
    Route::resource('officials', App\Http\Controllers\Admin\OfficialController::class);
});

require __DIR__ . '/auth.php';
