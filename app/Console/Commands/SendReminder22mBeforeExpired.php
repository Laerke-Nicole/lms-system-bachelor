<?php

namespace App\Console\Commands;

use App\Models\Training;
use App\Notifications\NewReminder22mPostTraining;
use Illuminate\Console\Command;

class SendReminder22mBeforeExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder22m-before-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders 22 months after a training is completed if leader has not rebooked';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twentyTwoMonthsAgo = now()->subMonths(22)->toDateString();

        Training::with(['trainingSlot.course', 'orderedBy'])
            ->where('status', 'Expiring')
            ->where('reminder_sent_18_m', true)
            ->where('reminder_sent_22_m', false)
            ->whereDate('completed_at', $twentyTwoMonthsAgo)
            ->each(function ($training) {
                $leader = $training->orderedBy;
                $courseName = $training->course->title;

                // Check if leader has made any new booking since the 18-month mark
                $eighteenMonthsAfterCompletion = $training->completed_at->copy()->addMonths(18);

                $hasRebooked = Training::where('ordered_by_id', $leader->id)
                    ->where('created_at', '>=', $eighteenMonthsAfterCompletion)
                    ->exists();

                if ($hasRebooked) {
                    // Leader has rebooked, mark as sent but don't send notification
                    $training->update(['reminder_sent_22_m' => true]);
                    return;
                }

                try {
                    $leader->notify(new NewReminder22mPostTraining($training->id, $courseName));
                } catch (\Throwable $e) {
                    \Log::error('Failed to send 22-month reminder notification: ' . $e->getMessage());
                }

                $training->update(['reminder_sent_22_m' => true]);
            });

        $this->info('22-month reminders sent.');
    }
}
