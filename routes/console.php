<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//delete expired token when reset password
Schedule::command('auth:clear-resets')->everyFifteenMinutes();
Schedule::command('app:update-expiring-trainings')->daily();
Schedule::command('app:send-reminder-before-training')->daily();
Schedule::command('app:send-reminder18m-before-expired')->daily();
Schedule::command('app:send-reminder22m-before-expired')->daily();
Schedule::command('model:prune')->daily();
