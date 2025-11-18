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
        session(['bookings.course_id' => 'course_id']);

//        clear all session data if user goes back on the page
        session()->forget(['booking.training_slot_id', 'booking.user_ids']);

        return redirect()->route('bookings.slot');
    }

    /**
     * step 2 - select an available training slot
     */
    public function selectTrainingSlot()
    {
        $session = session('bookings.course_id');

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
            'training_slot_id' => 'required|exists:training_slots,id|status:Available',
        ]);

        session(['booking.training_slot_id' => 'training_slot_id']);

        //        clear all session data if user goes back on the page
        session()->forget(['booking.training_slot_id', 'booking.user_ids']);

        return redirect()->route('trainings.bookings.step3-employees');
    }

    /**
     * step 3 - choosing the employees
     */
    public function selectEmployees()
    {
        $session = session('bookings.training_slot_id');

//        throw and 404 error if there's no session
        abort_if(!$session, 404);

//        show only the users that are in the same site as the logged in user booking
        $employees = User::where(Auth::user()->site);

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
            'user_id' => 'required|exists:user,id|',
        ]);

//        save the employee choices in the session
        session(['booking.employee_ids' => 'user_id']);

//        Clear any progress from later steps (in case user goes backwards)
        session()->forget(['booking.user_id', 'booking.user_ids']);

        return redirect()->route('trainings.bookings.step4-summary');
    }


}
