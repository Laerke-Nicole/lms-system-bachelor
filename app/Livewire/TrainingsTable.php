<?php

namespace App\Livewire;

use App\Models\Course;
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
        $user = auth()->user();

//        get trainings table information with the relations where its filtered by status
        $query = Training::query()
            ->with([
                'trainingSlot.course.courseMaterials',
                'trainingSlot.course.evaluation',
                'trainingSlot.course.followUpTest',
                'trainingSlot.trainer',
                'orderedBy',
                'trainingUsers.user',
            ])
            ->join('training_slots', 'training_slots.id', '=', 'trainings.training_slot_id')
            ->select('trainings.*');

        // show the trainings based on user role
        if ($user->role === 'user') {
            // users see only their own trainings
            $query->when($user->role === 'user', function ($q) use ($user) {
                $q->whereHas('trainingUsers', fn($t) => $t->where('user_id', $user->id));
            });
        } elseif ($user->role === 'leader') {
            // leader see trainings where the users are in their site
            $query->when($user->role === 'leader', function ($q) use ($user) {
                $q->whereHas('trainingUsers.user', fn($u) => $u->where('site_id', $user->site_id));
            });
        }

        // filtering
        match ($this->filter) {
            'upcoming'  => $query->where('trainings.status', 'Upcoming'),
            'completed' => $query->where('trainings.status', 'Completed'),
            'expired'   => $query->where('trainings.status', 'Expired'),
            default     => null,
        };

//            sort upcoming and all by training_date ascending
        if (in_array($this->filter, ['upcoming', 'all'])) {
            $query->orderBy('training_slots.training_date');
        } else {
//            sort completed and expired by training_date descending
            $query->orderBy('training_slots.training_date', 'desc');
        }

//        return the sorting with 5 pagination
        return $query->paginate(5);
    }
}
