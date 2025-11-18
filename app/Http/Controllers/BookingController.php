<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Training;
use App\Models\TrainingSlot;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * step 1 - choosing the course
     */
    public function selectCourse()
    {
        $courses = Course::all();

        return view('trainings.bookings.step1-course', compact('courses'));
    }

    /**
     * step 1 - post the course choice
     */
    public function storeCourse(Request $request)
    {
        // validate the user input
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

//        store the course_id in a session
        session(['booking.course_id' => $validated['course_id']]);

//        clear all session data if user goes back on the page
        session()->forget(['booking.training_slot_id', 'booking.user_ids']);

        return redirect()->route('bookings.slot');
    }

    /**
     * step 2 - select an available training slot
     */
    public function selectTrainingSlot()
    {
//        retrieve the session
        $session = session('booking.course_id');

//        throw and 404 error if there's no session
        abort_if(!$session, 404);

        $trainingSlots = TrainingSlot::where('course_id', $session)
            ->where('status', 'Available')
            ->orderBy('training_date', 'asc')
            ->get();

        return view('trainings.bookings.step2-slot', compact('trainingSlots'));
    }

    /**
     * step 2 - post the training slot choice
     */
    public function storeTrainingSlot(Request $request)
    {
        // validate the user input
        $validated = $request->validate([
            'training_slot_id' => 'required|exists:training_slots,id',
        ]);

//        store the trainings slot id in the session
        session(['booking.training_slot_id' => $validated['training_slot_id']]);

//        clear session data about the users chosen if user goes back to the last page
        session()->forget(['booking.user_ids']);

        return redirect()->route('trainings.employees');
    }

    /**
     * step 3 - choosing the employees
     */
    public function selectEmployees()
    {
//        retrieve the session
        $session = session('booking.training_slot_id');

//        throw an 404 error if there's no session
        abort_if(!$session, 404);

//        show only the users that are in the same site as the logged in user booking
        $employees = User::where('site_id', auth()->user()->site_id)->get();

        return view('trainings.bookings.step3-employees', compact('employees'));
    }

    /**
     * step 3 - post of the employees chosen
     */
    public function storeEmployees(Request $request)
    {
        // validate the user input
        $validated = $request->validate([
//            make sure they atleast picked one employee
            'user_ids'   => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ]);

//        save the employee choices in the session
        session(['booking.user_ids' => $validated['user_ids']]);

        return redirect()->route('trainings.summary');
    }

    /**
     * step 4 - show a summary of the booking
     */
    public function showSummary(Request $request)
    {
//        retrieve the session
        $session = session('booking');

//        throw an 404 error if a course_id, training_slot_id and user_id arent in the session
        abort_if(!$session || !isset($session['course_id'], $session['training_slot_id'], $session['user_ids']), 404);

//        get the ids that are in the chosen in the session
        $course = Course::findOrFail($session['course_id']);
        $trainingSlot = TrainingSlot::with('trainer')->findOrFail($session['training_slot_id']);
        $trainer = $trainingSlot->trainer;
        $employees = User::whereIn('id', $session['user_ids'])->get();

        return view('trainings.bookings.step4-summary', compact('course', 'trainingSlot', 'employees', 'trainer'));
    }

    /**
     * Store and create the confirmed booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $session = session('booking');

//        throw an 404 error if a course_id, training_slot_id and user_id arent in the session
        abort_if(!$session || !isset($session['course_id'], $session['training_slot_id'], $session['user_ids']), 404);

//        validate the confirmed data
        $validated = [
            'training_slot_id' => $session['training_slot_id'],
            'ordered_by_id' => auth()->id(),
            'status' => 'Upcoming',
            'reminder_sent_18_m' => false,
            'reminder_sent_22_m' => false,
            'reminder_before_training' => null,
        ];

//        create a new training in the db
        $training = Training::create($validated);

//        add the selected employees
        $training->employees()->sync($session['user_ids']);

//        update the slot to unavailable
        TrainingSlot::where('id', $session['training_slot_id'])->update(['status' => 'Unavailable']);

//        remove all the data from the session
        session()->forget('booking');

        return view('trainings.bookings.step5-confirmed', compact('training'));
    }
}
