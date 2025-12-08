<?php

use App\Http\Controllers\RequirementController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\CourseMaterialListController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('courses.requirements', RequirementController::class);
    Route::resource('courses.course_materials', CourseMaterialController::class);
});

//the list showing the courses
Route::get('trainings/{training}/sections/course-materials', [CourseMaterialListController::class, 'courseMaterialList'])->name('sections.course-materials');
