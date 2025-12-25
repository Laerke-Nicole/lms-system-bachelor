<?php

namespace App\Console\Commands;

use App\Models\Training;
use App\Notifications\NewReminderBeforeTraining;
use Illuminate\Console\Command;

class SendReminderBeforeTraining extends Command
{
    protected $signature = 'app:send-reminder-before-training';
    protected $description = 'Send reminders a week before upcoming trainings';

    public function handle()
    {
        $sevenDaysFromNow = now()->addDays(7)->toDateString();

//        get the trainings that are upcoming and reminder_before_training is null
        Training::with(['trainingSlot.course', 'users'])
            ->where('status', 'Upcoming')
            ->whereNull('reminder_before_training')
            ->whereHas('trainingSlot', fn($query) => $query->whereDate('training_date', $sevenDaysFromNow))
            ->each(function ($training) {
                $courseName = $training->course->title;
                $trainingDate = $training->trainingSlot->date_time_formatted;

//                send to all those trainings to the users in the training
                try {
                    foreach ($training->users as $user) {
                        $user->notify(new NewReminderBeforeTraining($training->id, $courseName, $trainingDate));
                    }
                } catch (\Throwable $e) {
                    \Log::error('Failed to send training reminder notification: ' . $e->getMessage());
                }

                $training->update(['reminder_before_training' => now()]);
            });

        $this->info('Training reminders sent a week before the training.');
    }
}
