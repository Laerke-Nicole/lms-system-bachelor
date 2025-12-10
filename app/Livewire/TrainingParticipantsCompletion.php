<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingUser;
use Illuminate\Http\Request;
use Livewire\Component;

class TrainingParticipantsCompletion extends Component
{
    public Training $training;

    public function mount(Training $training)
    {
        $this->training = $training;
    }

    public function render()
    {
        return view('livewire.training-participants-completion', [
            'trainingUsers' => $this->training->trainingUsers()->with('user')->paginate(5),
        ]);
    }

    public function markEvaluationCompleted($trainingUserId)
    {
        $trainingUser = TrainingUser::findOrFail($trainingUserId);

//        if the update is already made
        if ($trainingUser->evaluation_completed) {
            return;
        }

        // toggle
        $trainingUser->update([
            'completed_evaluation_at' =>
                $trainingUser->completed_evaluation_at ?? now(),
        ]);
    }
}
