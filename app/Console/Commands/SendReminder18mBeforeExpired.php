<?php

namespace App\Console\Commands;

use App\Models\Training;
use App\Notifications\NewReminder18mPostTraining;
use Illuminate\Console\Command;

class SendReminder18MBeforeExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder18m-before-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders 18 months after a training is completed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eighteenMonthsAgo = now()->subMonths(18)->toDateString();

        Training::with(['trainingSlot.course', 'orderedBy'])
            ->where('status', 'Completed')
            ->where('reminder_sent_18_m', false)
            ->whereDate('completed_at', $eighteenMonthsAgo)
            ->each(function ($training) {
                $courseName = $training->course->title;

                try {
                    $training->orderedBy->notify(new NewReminder18mPostTraining($training->id, $courseName));
                } catch (\Exception $e) {
                    \Log::error('Failed to send 18-month reminder notification: ' . $e->getMessage());
                }

                $training->update(['reminder_sent_18_m' => true]);
            });

        $this->info('18-month reminders sent.');
    }
}
