<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->controller(NotificationController::class)->group(function () {
    Route::post('/notifications/{notificationId}/mark-as-read', 'markAsRead')->name('notifications.markAsRead');
});
