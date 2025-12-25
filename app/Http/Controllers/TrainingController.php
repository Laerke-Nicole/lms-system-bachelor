<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use App\Notifications\TrainingUpdated;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $trainings = Training::latest()->paginate(5);
        return view('crud.trainings.index', compact('trainings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        // get the logged in users training info (for showing their own certificate)
        $userTrainingRecord = $training->trainingUsers()
            ->where('user_id', auth()->id())
            ->with('signature')
            ->first();

        return view('crud.trainings.show', compact('training', 'userTrainingRecord'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
//        only leaders and admins can edit trainings
        abort_unless(in_array(auth()->user()->role, ['leader', 'admin']), 403);

//       cant edit a training that is expiring or completed
        if ($training->status === 'Expiring' || $training->status === 'Completed') {
            return redirect()->route('trainings.index')->with('error', 'Cannot edit trainings with this status.');
        }

        $slot = $training->trainingSlot;
        $places = ['Online', 'On site'];
        $statuses = [];

//        if status is pending admin can change it to upcoming
        if ($training->status === 'Pending') {
            $statuses = ['Pending', 'Upcoming'];
        }

//        if status is already upcoming admin cant change back to pending
        elseif ($training->status === 'Upcoming') {
//            if training is today or in the past admin can choose upcoming or completed
            if ($slot->training_date->isToday() || $slot->training_date->isPast()) {
                $statuses = ['Upcoming', 'Completed'];
            }
//            if training is in the future it says as upcoming
            else {
                $statuses = ['Upcoming'];
            }
        }

//        if training status is expiring
        else {
            $statuses = ['Expiring'];
        }

        return view('crud.trainings.edit', compact('training','places', 'slot', 'statuses'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
//        only leaders and admins can update trainings
        abort_unless(in_array(auth()->user()->role, ['leader', 'admin']), 403);

//        cant update a training that is completed or expiring
        if ($training->status === 'Expiring' || $training->status === 'Completed') {
            return redirect()->route('trainings.index')->with('error', 'Cannot update trainings with this status.');
        }

        // validate the user input
        $validated = $request->validate([
            'training_date' => 'required|date',
            'place' => 'required',
            'status' => 'required',
            'participation_link' => 'nullable|url',
        ]);

//        update the training date and participation link on trainingslot
        $training->trainingSlot->update([
            'training_date' => $validated['training_date'],
            'place' => $validated['place'],
            'participation_link' => $validated['participation_link'] ?? null,
        ]);


//        update status of training
//        update the status to the validated one
        $training->status = $validated['status'];

//        if training status is set to completed, then set the completed_at to the training date
        if ($validated['status'] === 'Completed') {
            $training->completed_at = $training->trainingSlot->training_date;
        }

//        if the status is set back to upcoming then make sure the completed_at is always null
        if ($validated['status'] === 'Upcoming') {
            $training->completed_at = null;
        }

//        save changes to training
        $training->save();

//        send notification to admins and orderedBy user (excluding the updater)
        $courseName = $training->course->title;
        $updaterName = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $currentUserId = auth()->id();

//        notify all admins (except if they're the updater)
        try {
            $admins = User::where('role', 'admin')->where('id', '!=', $currentUserId)->get();
            foreach ($admins as $admin) {
                $admin->notify(new TrainingUpdated($courseName, $updaterName, $training->id));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send training update notification to admins: ' . $e->getMessage());
        }

//        notify the orderedBy user (except if they're the updater)
        try {
            if ($training->orderedBy && $training->orderedBy->id !== $currentUserId) {
                $training->orderedBy->notify(new TrainingUpdated($courseName, $updaterName, $training->id));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send training update notification to orderedBy user: ' . $e->getMessage());
        }

        //  redirect the user and send a success message
        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }


    /**
     * Remove the training based on the id from the db.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
//        only admins can delete trainings
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('trainings.index')->with('error', 'Only administrators can delete trainings.');
        }

//        cant delete if the training is completed or expiring
        if ($training->status === 'Completed' || $training->status === 'Expiring') {
            return redirect()->route('trainings.index')->with('error', 'Cannot delete trainings with this status.');
        }

        // delete the training from the db
        $training->delete();

        //  redirect the user and send a success message
        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}
