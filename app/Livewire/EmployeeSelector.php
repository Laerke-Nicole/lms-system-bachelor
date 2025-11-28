<?php

namespace App\Livewire;

use Livewire\Component;

class EmployeeSelector extends Component
{
    public $employees = [];
    public $selected = [];
    public $maxParticipants;

    public function mount($employees, $maxParticipants)
    {
        $this->employees = $employees;
        $this->selected = [];
        $this->maxParticipants = $maxParticipants;
    }

    public function clearAll()
    {
        $this->selected = [];
    }

    public function updatedSelected()
    {
        if (count($this->selected) > $this->maxParticipants) {

            // Remove the last selected item
            array_pop($this->selected);
        }
    }


    public function render()
    {
        return view('livewire.employee-selector', ['maxParticipants' => $this->maxParticipants]);
    }
}
