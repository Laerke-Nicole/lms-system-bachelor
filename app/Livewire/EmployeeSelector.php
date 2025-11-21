<?php

namespace App\Livewire;

use Livewire\Component;

class EmployeeSelector extends Component
{
    public $employees = [];
    public $selected = [];

    public function mount($employees)
    {
        $this->employees = $employees;
        $this->selected = [];
    }

    public function selectAll()
    {
        $this->selected = collect($this->employees)->pluck('id')->toArray();
    }

    public function clearAll()
    {
        $this->selected = [];
    }


    public function render()
    {
        return view('livewire.employee-selector');
    }
}
