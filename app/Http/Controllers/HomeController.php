<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $trainings = $this->showTrainingsOverview();

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

        $courses = Course::all();

        return view('home', compact('trainings', 'participateTraining', 'pendingTrainingCount', 'upcomingTrainingCount', 'completedTrainingCount', 'courses'));
    }

    //   show trainings based on user role
    public function showTrainingsOverview()
    {
        $user = auth()->user();

//        get trainings with only the relationships needed for display
        $query = Training::query()
            ->with(['trainingSlot.course', 'orderedBy'])
            ->join('training_slots', 'training_slots.id', '=', 'trainings.training_slot_id')
            ->select('trainings.*');

        // show the trainings based on user role
        if ($user->role === 'user') {
            // users see only their own trainings
            $query->whereHas('trainingUsers', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } elseif ($user->role === 'leader') {
            // leader see trainings where the users are in their site
            $query->whereHas('trainingUsers.user', function ($q) use ($user) {
                $q->where('site_id', $user->site_id);
            });
        }

        return $query->orderBy('training_slots.training_date', 'desc')->paginate(6);
    }

    /**
     * Return trainings as JSON for admin calendar
     */
    public function calendarTrainings(Request $request)
    {
        $start = Carbon::parse($request->query('start'))->startOfDay();
        $end = Carbon::parse($request->query('end'))->endOfDay();

        $trainings = Training::query()
            ->with(['trainingSlot.course', 'orderedBy.site.company'])
            ->whereHas('trainingSlot', function ($query) use ($start, $end) {
                $query->whereBetween('training_date', [$start, $end]);
            })
            ->get();

        return response()->json(
            $trainings->map(function ($training) {
                $isPending = $training->status === 'Pending';
                $companyName = $training->orderedBy?->site?->company?->company_name;

                return [
                    'id' => $training->id,
                    'title' => $training->trainingSlot->course->title,
                    'start' => $training->trainingSlot->training_date->toIso8601String(),
                    'url' => route('trainings.show', $training->id),
                    'backgroundColor' => $isPending ? '#6c757d' : '#0d6efd',
                    'borderColor' => $isPending ? '#6c757d' : '#0d6efd',
                    'extendedProps' => [
                        'status' => $training->status,
                        'company' => $companyName,
                    ],
                ];
            })->values()
        );
    }
}
