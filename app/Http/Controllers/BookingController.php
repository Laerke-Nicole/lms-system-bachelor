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


}
