<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('classes', ClassController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('students', StudentController::class);
        Route::resource('penalties', PenaltyController::class)->except(['show']);
    });

    // Teacher attendance management
    Route::middleware('role:teacher,admin')->group(function () {
        Route::resource('attendances', AttendanceController::class);
        Route::get('attendance/report/month', [AttendanceController::class, 'reportByMonth'])->name('attendance.report.month');
        Route::get('attendance/class/{class}', [AttendanceController::class, 'byClass'])->name('attendance.byClass');
        Route::get('attendance/absent', [AttendanceController::class, 'absentList'])->name('attendance.absent');
    });
});

require __DIR__.'/auth.php';
