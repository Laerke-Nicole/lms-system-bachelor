<?php

namespace App\Console\Commands;

use App\Models\Training;
use Illuminate\Console\Command;

class UpdateExpiringTrainings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expiring-trainings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update completed trainings to expiring status after 18 months';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Training::where('status', 'Completed')
            ->where('completed_at', '<=', now()->subMonths(18))
            ->update(['status' => 'Expiring']);

        $this->info('Expiring trainings updated.');
    }
}
