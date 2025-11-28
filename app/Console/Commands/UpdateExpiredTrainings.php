<?php

namespace App\Console\Commands;

use App\Models\Training;
use Illuminate\Console\Command;

class UpdateExpiredTrainings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-trainings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $trainings = Training::where('status', 'Completed')
            ->whereDate('completed_at', '<=', now()->subMonths(24))
            ->get();

        foreach ($trainings as $training) {
            $training->update(['status' => 'Expired']);
        }

        $this->info('Expired trainings updated.');
    }
}
