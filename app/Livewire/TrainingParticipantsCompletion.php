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
            'trainingUsers' => $this->training->trainingUsers()->with('user')->get(),
        ]);
    }

    public function markTestCompleted($trainingUser)
    {
//        if the signed at already has a value then prevent the admin from making changes
        if ($trainingUser->signed_at) {
            return back()->withErrors(['signed_at' => 'The user has already signed.']);
        }

        TrainingUser::all();

        // set the datetime of completed_test_at when the admin marks it
        $trainingUser->update([
            'completed_test_at' => now(),
        ]);
    }

    public function markEvaluationCompleted($trainingUser)
    {
//        if the signed at already has a value then prevent the admin from making changes
        if ($trainingUser->signed_at) {
            return back()->withErrors(['signed_at' => 'The user has already signed.']);
        }

        TrainingUser::all();

        // set the datetime of completed_evaluation_at when the admin marks it
        $trainingUser->update([
            'completed_evaluation_at' => now(),
        ]);
    }
}
