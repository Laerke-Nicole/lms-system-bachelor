<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingSlot;
use Livewire\Component;

class TrainingsTable extends Component
{
    public function render()
    {
        return view('livewire.trainings-table');
    }

    public $paginationTheme = 'bootstrap';

    public $filter = 'all';

    //    update filtering when clicking the filter btns
    public function setFilter($value)
    {
        $this->filter = $value;
    }

    //    return the filtering btn options
    public function getTrainingsProperty()
    {
        $query = Training::query()
            ->with(['trainingSlot.course.courseMaterials' => function ($query) {
                $query->where('material_type', 'Preparation');
            },
                'trainingSlot.trainer', 'orderedBy'])
            ->join('training_slots', 'training_slots.id', '=', 'trainings.training_slot_id')
            ->select('trainings.*');

        // filtering
        match ($this->filter) {
            'upcoming'  => $query->where('trainings.status', 'Upcoming'),
            'completed' => $query->where('trainings.status', 'Completed'),
            'expired'   => $query->where('trainings.status', 'Expired'),
            default     => null,
        };

//            sort upcoming and all by training_date ascending
        if (in_array($this->filter, ['upcoming', 'all'])) {
            $query->orderBy('training_slots.training_date', 'asc');
        } else {
//            sort completed and expired by training_date descending
            $query->orderBy('training_slots.training_date', 'desc');
        }

//        return the sorting with 5 pagination
        return $query->paginate(5);
    }

    //    show table heads on training index based on which filtering is active
    public function getTableHeadersProperty()
    {
//        store the different standard headers
        $base = ['Date', 'Course', 'Trainer', 'Ordered by'];
        $actions = ['Actions'];

//        show the headers based on the status in the filter in the right order
        return match ($this->filter) {
            'upcoming' => [...$base, 'Place', 'Reminder before training', ...$actions],
            'completed', 'expired' => [...$base, 'Reminder 18m', 'Reminder 22m', ...$actions],
            'all' => [...$base, 'Place', 'Reminder before', 'Reminder 18m', 'Reminder 22m', 'Status', ...$actions],
            default => [...$base, ...$actions],
        };
    }
}
