<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\AccreditationController;

// Technology & Information Center Page
Route::get('/technology', function () {
    return view('pages.technology');
})->name('technology');

// Procurement section
Route::get('bid-opportunities', [ProcurementController::class, 'bidOpportunities'])->name('procurement.bid');
Route::get('philgeps-posting', [ProcurementController::class, 'philgepsPosting'])->name('procurement.philgeps');

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
Route::get('/academics/coe', [App\Http\Controllers\CollegePageController::class, 'showPublic'])->defaults('college', 'coe')->name('academics.coe');
Route::get('/academics/coac', [App\Http\Controllers\CollegePageController::class, 'showPublic'])->defaults('college', 'coac')->name('academics.coac');
Route::get('/academics/coet', [App\Http\Controllers\CollegePageController::class, 'showPublic'])->defaults('college', 'coet')->name('academics.coet');
Route::view('/admissions', 'pages.admissions')->name('admissions');
Route::get('/admissions/undergraduate-programs', [App\Http\Controllers\AdmissionsController::class, 'undergraduatePrograms'])->name('admissions.undergraduate');
Route::view('/admissions/enrollment-procedure', 'pages.admissions.enrollment_procedure')->name('admissions.enrollment');
Route::view('/facilities', 'pages.facilities')->name('facilities');
Route::view('/student-services', 'pages.student_services')->name('student_services');
Route::view('/transparency-seal', 'pages.transparency_seal')->name('transparency_seal');
Route::get('/officials', [App\Http\Controllers\OfficialController::class, 'index'])->name('officials');
Route::get('/directors-corner', [App\Http\Controllers\DirectorCornerController::class, 'index'])->name('directors.corner');
Route::get('/directors-corner/posts/{slug}', [App\Http\Controllers\DirectorCornerController::class, 'show'])->name('directors.corner.post.show');
Route::get('/news-events', [App\Http\Controllers\NewsController::class, 'index'])->name('news_events');
Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/announcements/{announcement}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
Route::get('/academics/{college}', [App\Http\Controllers\CollegePageController::class, 'showPublic'])->name('academics.show');

// Program Accreditation
Route::get('/accreditation', [AccreditationController::class, 'index'])->name('accreditation.index');
Route::get('/accreditation/course/{course}', [AccreditationController::class, 'show'])->name('accreditation.course.show');
Route::post('/accreditation/course/{course}', [AccreditationController::class, 'verify'])->name('accreditation.course.verify');

// Assistant Director for Research and Extension Routes
Route::get('/assistant-director-research-extension', [App\Http\Controllers\ADREController::class, 'index'])->name('adre');
Route::get('/tiptto/posts/{slug}', [App\Http\Controllers\ADREController::class, 'showPost'])->name('tiptto.post.show');

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
    Route::resource('student-organizations', App\Http\Controllers\Admin\StudentOrganizationController::class)
        ->except(['show', 'index'])
        ->parameters(['student-organizations' => 'student_organization']);
    Route::put('departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('categories', [App\Http\Controllers\Admin\PostController::class, 'indexCategory'])->name('categories.index');
    Route::get('categories/create', [App\Http\Controllers\Admin\PostController::class, 'createCategory'])->name('categories.create');
    Route::post('categories', [App\Http\Controllers\Admin\PostController::class, 'storeCategory'])->name('categories.store');

    // Users management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);

    // Procurement management
    Route::get('procurements', [App\Http\Controllers\Admin\ProcurementController::class, 'index'])->name('procurements.index');
    Route::get('procurements/create', [App\Http\Controllers\Admin\ProcurementController::class, 'create'])->name('procurements.create');
    Route::post('procurements', [App\Http\Controllers\Admin\ProcurementController::class, 'store'])->name('procurements.store');
    Route::get('procurements/{id}/edit', [App\Http\Controllers\Admin\ProcurementController::class, 'edit'])->name('procurements.edit');
    Route::put('procurements/{id}', [App\Http\Controllers\Admin\ProcurementController::class, 'update'])->name('procurements.update');
    Route::delete('procurements/{id}', [App\Http\Controllers\Admin\ProcurementController::class, 'destroy'])->name('procurements.destroy');
    Route::delete('procurements/{id}/po', [App\Http\Controllers\Admin\ProcurementController::class, 'destroyPoFile'])->name('procurements.po.destroy');

    // TIPTTO Posts Management
    Route::resource('tiptto_posts', App\Http\Controllers\Admin\TIPTTOPostController::class);

    // Director's Corner posts
    Route::resource('director_posts', App\Http\Controllers\Admin\DirectorPostController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
