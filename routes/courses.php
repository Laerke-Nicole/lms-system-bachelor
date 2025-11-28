<?php

use App\Http\Controllers\PreparationController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\FollowUpMaterialController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('courses.preparations', PreparationController::class);
    Route::resource('courses.requirements', RequirementController::class);
    Route::resource('courses.follow_up_materials', FollowUpMaterialController::class);
});
