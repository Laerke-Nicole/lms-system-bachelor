<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Training;
use App\Models\TrainingSlot;
use App\Models\User;
use App\Notifications\NewTraining;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * step 1 - choosing the course
     */
    public function selectCourse()
    {
        $courses = Course::all();

        return view('bookings.step1-course', compact('courses'));
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

        return redirect()->route('trainings.bookings.slot');
    }

    /**
     * step 2 - select an available training slot
     */
    public function selectTrainingSlot()
    {
//        retrieve the session
        $courseId = session('booking.course_id');

//        throw and 404 error if there's no session
        abort_if(!$courseId, 404);

//        get the requirements for this training slots, course
        $course = Course::with('requirements')->findOrFail($courseId);

        return view('bookings.step2-slot', compact('course'));
    }

    /**
     * step 2 - availability calendar
     */
    public function availability(Request $request)
    {
        $courseId = session('booking.course_id');
        abort_if(!$courseId, 404);

        $start = Carbon::parse($request->query('start'))->toDateString();
        $end   = Carbon::parse($request->query('end'))->toDateString();

        // taken = any slot exists for that day (per your “whole day” rule)
        $takenDays = TrainingSlot::query()
            ->where('course_id', $courseId)
            ->whereBetween('training_day', [$start, $end])
            ->pluck('training_day');

        return response()->json(
            $takenDays->map(fn ($day) => [
                'start' => $day,
                'end' => Carbon::parse($day)->addDay()->toDateString(),
                'display' => 'background',
                'classNames' => ['day-taken'],
            ])->values()
        );
    }

    /**
     * step 2 - post the training slot choice
     */
    public function storeTrainingSlot(Request $request)
    {
//        // validate the user input
//        $validated = $request->validate([
//            'training_slot_id' => 'required|exists:training_slots,id',
//        ]);
//
////        store the trainings slot id in the session
//        session(['booking.training_slot_id' => $validated['training_slot_id']]);
//
////        clear session data about the users chosen if user goes back to the last page
//        session()->forget(['booking.user_ids']);
//
//        return redirect()->route('trainings.bookings.employees');

        $courseId = session('booking.course_id');
        abort_if(!$courseId, 404);

        $validated = $request->validate([
            'training_day' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
        ]);

        $day = $validated['training_day'];

        try {
            $slot = TrainingSlot::create([
                'course_id' => $courseId,
                'training_day' => $day,
                'training_date' => $day . ' 08:00:00',
                'status' => 'Available',
                'place' => null,
                'created_by_admin_id' => null,
                'trainer_id' => null,
            ]);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->withErrors(['training_day' => 'That day is already taken. Please pick another.']);
            }

            throw $e;
        }

        session(['booking.training_slot_id' => $slot->id]);
        session()->forget(['booking.user_ids']);

        return redirect()->route('trainings.bookings.employees');
    }

    /**
     * step 3 - choosing the employees
     */
    public function selectEmployees()
    {
//        retrieve the session data
        $slotId = session('booking.training_slot_id');
        $courseId = session('booking.course_id');

//        throw an 404 error if there's no session
        abort_if(!$slotId || !$courseId, 404);

//        fetch to show on the view
        $course = Course::findOrFail($courseId);
        $trainingSlot = TrainingSlot::with('trainer')->findOrFail($slotId);

//        show only the users that are in the same site as the logged in user booking ordered by names
        $employees = User::where('site_id', auth()->user()->site_id)->where('leader_can_view_info', 1)->orderBy('first_name')->orderBy('last_name')->get();

        return view('bookings.step3-employees', compact('employees', 'course', 'trainingSlot'));
    }

    /**
     * step 3 - post of the employees chosen
     */
    public function storeEmployees(Request $request)
    {
        // Get the course to check max participants
        $courseId = session('booking.course_id');
        $course = Course::findOrFail($courseId);

        // validate the user input
        $validated = $request->validate([
//            make sure they atleast picked one employee
            'user_ids'   => 'required|array|min:1|max:' . $course->max_participants,
            'user_ids.*' => 'exists:users,id',
        ], [
//            customized error messages
            'user_ids.required' => 'Please select at least one employee.',
            'user_ids.array'    => 'Please select at least one employee.',
            'user_ids.min'      => 'You must choose at least one employee.',
            'user_ids.max'      => 'You can only select up to ' . $course->max_participants . ' employees for this course.',
            'user_ids.*.exists' => 'One of the selected employees does not exist.',
        ]);

//        save the employee choices in the session
        session(['booking.user_ids' => $validated['user_ids']]);

        return redirect()->route('trainings.bookings.confirm');
    }

    /**
     * step 4 - confirm the booking by showing what they are booking
     */
    public function showConfirm(Request $request)
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

        return view('bookings.step4-confirm', compact('course', 'trainingSlot', 'employees', 'trainer'));
    }

    /**
     * step 4 - store and create the confirmed booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeConfirm(Request $request)
    {
        $session = session('booking');

//        throw an 404 error if a course_id, training_slot_id and user_id arent in the session
        abort_if(!$session || !isset($session['course_id'], $session['training_slot_id'], $session['user_ids']), 404);

        $request->merge([
            'training_slot_id' => $session['training_slot_id']
        ]);

        $request->validate([
            // the training slot they to book should stil exist
            'training_slot_id' => ['required', 'integer', 'exists:training_slots,id'],
        ]);

//        the training slot should still have the available status
        $slot = TrainingSlot::where('id', $session['training_slot_id'])->where('status', 'Available')->firstOrFail();

//        validate the confirmed data
        $validated = [
            'training_slot_id' => $session['training_slot_id'],
            'ordered_by_id' => auth()->id(),
            'status' => 'Pending',
            'reminder_sent_18_m' => false,
            'reminder_before_training' => null,
        ];

//        create a new training in the db
        $training = Training::create($validated);

//        add the selected employees
        $training->users()->sync($session['user_ids']);

//        update the slot to unavailable
        $slot->update(['status' => 'Unavailable']);

//        send notification to the employees/users in the booking
//        get the different values the notification needs
        $course_name = $training->course->title;
        $training_date = $training->trainingSlot->training_date;

//        send notification to all participants
        try {
            foreach ($training->users as $user) {
                $user->notify(new NewTraining($course_name, $training_date, $training->id));
            }
        } catch (\Throwable $e) {
            \Log::error('Failed to send training notification to participants: ' . $e->getMessage());
        }

//        send notification to all admins
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewTraining($course_name, $training_date, $training->id));
            }
        } catch (\Throwable $e) {
            \Log::error('Failed to send training notification to admins: ' . $e->getMessage());
        }

//        remove all the data from the session
        session()->forget('booking');

        return redirect()->route('trainings.bookings.summary', $training->id);
    }

    /**
     * step 5 - show a summary of the booking
     */
    public function showSummary($id)
    {
        $training = Training::with(['trainingSlot.trainer', 'users', 'trainingSlot.course'])->findOrFail($id);

        return view('bookings.step5-summary', compact('training'));
    }
}
