<?php

namespace App\Livewire;

use App\Models\Training;
use Livewire\WithPagination;
use Livewire\Component;

class TrainingsTable extends Component
{
    public function render()
    {
        return view('livewire.trainings-table');
    }

    public $paginationTheme = 'bootstrap';

    //    filtering
    public $filter = 'all';

    //    update filtering when clicking the filter btns
    public function setFilter($value)
    {
        $this->filter = $value;
    }

    //    return the filtering options
    public function getTrainingsProperty()
    {
        return Training::when($this->filter === 'upcoming', fn($q) =>
            $q->where('status', 'Upcoming')
            )
            ->when($this->filter === 'completed', fn($q) =>
            $q->where('status', 'Completed')
            )
            ->when($this->filter === 'expired', fn($q) =>
            $q->where('status', 'Expired')
            )
            ->latest()
            ->paginate(5);
    }

    //    show table heads based on which filtering is active
    public function getTableHeadersProperty()
    {
        $base = ['Date', 'Course', 'Status', 'Place', 'Trainer', 'Ordered by'];
        $upcomingReminder = ['Reminder before training'];
        $completedReminder = ['Reminder sent 18 months', 'Reminder sent 22 months'];
        $actions = ['Actions'];

        $extra = match ($this->filter) {
            'upcoming' => $upcomingReminder,
            'completed', 'expired' => $completedReminder,
            'all' => [...$upcomingReminder, ...$completedReminder],
            default => [],
        };

        return [...$base, ...$extra, ...$actions];
    }
}
