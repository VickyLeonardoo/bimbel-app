<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YearController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Front\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about-us', function () {
    return view('about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('courses', CourseController::class) 
    ->middleware(['role:admin']);

    Route::resource('instructor', InstructorController::class)
    ->middleware(['role:admin']);
    
    Route::resource('visi-misi', VisiMisiController::class)
    ->middleware(['role:admin']);

    Route::resource('year', YearController::class)
    ->middleware(['role:admin']);

    Route::put('/discount/status/{discount:id}',[DiscountController::class, 'status'])->name('discount.status')->middleware(['role:admin']);
    Route::resource('discount', DiscountController::class)
    ->middleware(['role:admin']);

    Route::get('/instructor/{instructor:id}/education/create',[EducationController::class, 'create'])->name('instructor.education.create')->middleware(['role:admin']);
    Route::post('/instructor/{instructor:id}/education', [EducationController::class, 'store'])->name('instructor.education.store')->middleware(['role:admin']);
    Route::delete('/education/{education:id}', [EducationController::class, 'destroy'])->name('instructor.education.destroy')->middleware(['role:admin']);

    Route::prefix('client')->name('client.')->group(function () {

        Route::get('/dashboard',[DashboardController::class, 'index'])->name('front.dashboard')->middleware(['role:client']);
        
        // Route::put('/transaction/cancel/{transaction:id}',[UserTransactionController::class,'set_cancel'])
        // ->middleware('role:parent')
        // ->name('transaction.cancel');

        // Route::resource('transaction',UserTransactionController::class)
        // ->middleware('role:parent');

        // Route::resource('dashboard',HomeController::class)
        // ->middleware('role:parent');
    });


});

require __DIR__.'/auth.php';
