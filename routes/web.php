<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YearController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Front\ChildrenController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\TransactionController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\TransactionController as ControllersTransactionController;
use App\Http\Controllers\Front\TestimonialController as ControllersTestimonialController;


Route::get('/testimonials/{id}', [TestimonialController::class, 'show'])->name('admin.testimonials.show');
Route::post('/testimonials/{id}/toggle-visibility', [TestimonialController::class, 'toggleVisibility'])->name('admin.testimonials.toggle-visibility');
Route::post('/testimonials/bulk-action', [TestimonialController::class, 'bulkAction'])->name('admin.testimonials.bulk-action');
Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
Route::get('/testimonials/stats', [TestimonialController::class, 'getStats'])->name('admin.testimonials.stats');

Route::get('/client-testimonials-lists', [ControllersTestimonialController::class, 'index'])->name('testimonials.index');

Route::post('/check-promo', [PromoController::class, 'checkPromo'])->name('check-promo');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/',[DashboardController::class,'home'])->name('home');

Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::post('/testimonial', [ControllersTestimonialController::class, 'store'])->name('testimonial.store');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Suggested code may be subject to a license. Learn more: ~LicenseLog:357993683.

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[ControllersDashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified','role:admin|instructor']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/course/{course:id}/session',[CourseController::class, 'session'])
    ->middleware(['role:admin'])
    ->name('courses.session');

    Route::post('/course/{course:id}/session',[CourseController::class, 'session_store'])
    ->middleware(['role:admin'])
    ->name('courses.session.store');

    Route::resource('courses', CourseController::class) 
    ->middleware(['role:admin']);

    Route::resource('instructor', InstructorController::class)
    ->middleware(['role:admin']);
    
    Route::resource('visi-misi', VisiMisiController::class)
    ->middleware(['role:admin']);
 
    Route::resource('year', YearController::class)
    ->middleware(['role:admin']);

    Route::patch('/transaction/{transaction:id}/reject',[ControllersTransactionController::class, 'reject'])->name('transaction.reject');
    Route::patch('/transaction/{transaction:id}/approve',[ControllersTransactionController::class, 'approve'])->name('transaction.approve');

    Route::resource('transaction', ControllersTransactionController::class)
    ->middleware(['role:admin']);

    Route::put('/discount/status/{discount:id}',[DiscountController::class, 'status'])->name('discount.status')->middleware(['role:admin']);
    Route::resource('discount', DiscountController::class)
    ->middleware(['role:admin']);

    Route::get('/instructor/{instructor:id}/education/create',[EducationController::class, 'create'])->name('instructor.education.create')->middleware(['role:admin']);
    Route::post('/instructor/{instructor:id}/education', [EducationController::class, 'store'])->name('instructor.education.store')->middleware(['role:admin']);
    Route::delete('/education/{education:id}', [EducationController::class, 'destroy'])->name('instructor.education.destroy')->middleware(['role:admin']);

    Route::resource('enrollments',EnrollmentController::class)
    ->middleware(['role:admin']);

    Route::resource('attendance',AttendanceController::class)
    ->middleware(['role:admin|instructor']);

    Route::post('/attending/update-status',[AttendanceController::class, 'update_status'])
    ->middleware(['role:admin|instructor'])
    ->name('attendance.update.status');

    Route::post('/attending/update-status',[AttendanceController::class, 'update_status'])
    ->middleware(['role:admin|instructor'])
    ->name('attendance.update.status');
    
    Route::get('/attendance/{course:id}/report', [AttendanceController::class, 'show_report'])
    ->name('attendance.report');

    Route::resource('testimonial',TestimonialController::class)
    ->middleware(['role:admin|client']);


    Route::prefix('client')->name('client.')->group(function () {
        
        Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware(['role:client']);
        
        Route::resource('children',ChildrenController::class)
        ->middleware(['role:client']);
        
        Route::patch('/transaction/{transaction:id}/pending', [TransactionController::class, 'set_pending'])->name('transaction.pending');

        Route::resource('transaction', TransactionController::class)
        ->middleware(['role:client']);



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
