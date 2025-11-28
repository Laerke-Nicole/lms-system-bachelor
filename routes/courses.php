<?php

use App\Http\Controllers\RequirementController;
use App\Http\Controllers\CourseMaterialController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('courses.requirements', RequirementController::class);
    Route::resource('courses.course_materials', CourseMaterialController::class);
});
