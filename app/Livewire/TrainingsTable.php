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

}
