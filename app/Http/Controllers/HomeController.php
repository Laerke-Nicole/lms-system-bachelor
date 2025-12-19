<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        get the trainings that the user has today or starting within 24 hours to show participate in the training
        $participateTraining = auth()->user()->trainings()
            ->where('status', 'Upcoming')
            ->whereHas('trainingSlot', function($query) {
                $query->whereBetween('training_date', [now(), now()->addDay()]);
            })
            ->with('trainingSlot')
            ->get();

//        get the number of trainings with the pending/upcoming/completed status
        $pendingTrainingCount = Training::where('status', 'Pending')->count();
        $upcomingTrainingCount = Training::where('status', 'Upcoming')->count();
        $completedTrainingCount = Training::where('status', 'Completed')->count();


//        get trainings
        $trainings = Training::latest()->paginate(6);

        return view('home', compact('trainings', 'participateTraining', 'pendingTrainingCount', 'upcomingTrainingCount', 'completedTrainingCount'));
    }
}
