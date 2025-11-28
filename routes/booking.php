<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->controller(BookingController::class)->name('trainings.bookings.')->group(function () {
//    step 1 picking course
    Route::get('/course', 'selectCourse')->name('course');
    Route::post('/course', 'storeCourse')->name('course.store');

//    step 2 picking slot
    Route::get('/slot', 'selectTrainingSlot')->name('slot');
    Route::post('/slot', 'storeTrainingSlot')->name('slot.store');

//    step 3 picking the employees
    Route::get('/employees', 'selectEmployees')->name('employees');
    Route::post('/employees', 'storeEmployees')->name('employees.store');

//    step 4 summary of booking
    Route::get('/confirm', 'showConfirm')->name('confirm');
    Route::post('/confirm', 'storeConfirm')->name('confirm.store');

    Route::get('/summary/{id}', 'showSummary')->name('summary');
});
