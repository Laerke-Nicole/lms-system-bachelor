<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        get the trainings that the user has today or starting within 24 hours
        $participateTraining = auth()->user()->trainings()
            ->where('status', 'Upcoming')
            ->whereHas('trainingSlot', function($query) {
                $query->whereBetween('training_date', [now(), now()->addDay()]);
            })
            ->with('trainingSlot')
            ->get();

        return view('home', compact('participateTraining'));
    }
}
