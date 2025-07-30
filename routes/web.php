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
Route::view('/about/history', 'pages.about.history')->name('about.history');
Route::view('/about/mission', 'pages.about.mission')->name('about.mission');
Route::view('/about/values', 'pages.about.values')->name('about.values');
Route::view('/about/goals', 'pages.about.goals')->name('about.goals');
Route::view('/about/mandate', 'pages.about.mandate')->name('about.mandate');
Route::view('/about/hymn', 'pages.about.hymn')->name('about.hymn');
Route::view('/academics', 'pages.programs')->name('academics');
Route::view('/academics/coe', 'pages.academics_coe')->name('academics.coe');
Route::view('/academics/coac', 'pages.academics_coac')->name('academics.coac');
Route::view('/academics/coet', 'pages.academics_coet')->name('academics.coet');
Route::view('/admissions', 'pages.admissions')->name('admissions');
Route::view('/facilities', 'pages.facilities')->name('facilities');
Route::view('/student-services', 'pages.student_services')->name('student_services');
Route::get('/officials', [App\Http\Controllers\OfficialController::class, 'index'])->name('officials');
Route::get('/officials/{id}', [App\Http\Controllers\OfficialController::class, 'show'])->name('officials.show');
Route::get('/news-events', [App\Http\Controllers\NewsController::class, 'index'])->name('news_events');
Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements');
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/announcements/{announcement}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
Route::get('/academics/{college}', [App\Http\Controllers\CollegePageController::class, 'showPublic'])->name('academics.show');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('dashboard');
    Route::get('posts/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('posts.store');
    Route::resource('news', App\Http\Controllers\NewsController::class);
    Route::resource('announcements', App\Http\Controllers\AnnouncementController::class);
    Route::resource('jobs', App\Http\Controllers\JobController::class);
    Route::resource('events', App\Http\Controllers\EventController::class);
    Route::resource('officials', App\Http\Controllers\Admin\OfficialController::class);
    Route::resource('carousel-images', App\Http\Controllers\Admin\CarouselImageController::class);
    Route::resource('college-pages', App\Http\Controllers\Admin\CollegePageController::class);
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->except(['show']);
    Route::resource('faculties', App\Http\Controllers\Admin\FacultyController::class)->except(['show']);
    Route::get('categories', [App\Http\Controllers\Admin\PostController::class, 'indexCategory'])->name('categories.index');
    Route::get('categories/create', [App\Http\Controllers\Admin\PostController::class, 'createCategory'])->name('categories.create');
    Route::post('categories', [App\Http\Controllers\Admin\PostController::class, 'storeCategory'])->name('categories.store');
});

require __DIR__ . '/auth.php';
