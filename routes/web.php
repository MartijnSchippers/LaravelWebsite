<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UsersController;
use App\Models\Course;
use App\Models\Publification;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('my admin')->middleware('admin');
    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/checkout', [CheckoutController::class, 'pay']);

Route::prefix('/courses')->group(function () {
    Route::get('/', [CoursesController::class, 'show'])->name('show-courses')->middleware('auth');
    Route::post('/', [CartController::class, 'addToCart'])->name('addToCart')->middleware('auth');
    Route::get('/make-course', [CourseController::class, 'makeCourse'])->name('make-course')->middleware('admin');
    Route::post('/make-course', [CourseController::class, 'saveCourse'])->name('save-course')->middleware('admin');
});


Route::prefix('/courses/{slug}')->middleware('auth')->group(function () {

    Route::get('/', function ($slug) {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('course', ['course' => $course]);
    });

    Route::get('/edit', function ($slug) {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('course-edit', ['course' => $course]);
    });

    Route::prefix('/users')->middleware('admin')->group(function () {
        Route::get('/', [CourseController::class, 'manageUsers']); // Remove $slug parameter here
        Route::post('/add', [CourseController::class, 'addUser']); // Remove $slug parameter here
    });

    Route::post('/publish-course', [CourseController::class, 'editPublishStatus'])->name('publish-course')->middleware('admin');
});


Route::Get('/my-cart', [CartController::class, 'viewCartItems'])->name('my cart');

Route::get('/my-courses', function () {
    return view('my-courses', ['courses' => auth()->user()->courses]);
})->middleware('auth')->name('my courses');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () 
{
    Route::prefix('/users')->group(function () 
    {
        Route::get('/search', [UsersController::class, 'getUsersFromQuery'])->name('users.search');
    });
});

require __DIR__.'/auth.php';
