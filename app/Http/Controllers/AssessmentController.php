<?php

namespace App\Http\Controllers;

use App\Models\TrainingUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssessmentController extends Controller
{
    /**
     * Upload assessment file for a training participant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $trainingUserId
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $trainingUserId)
    {
        $request->validate([
            'assessment' => 'required|file|mimes:pdf|max:2048',
        ]);

        // find the training user
        $trainingUser = TrainingUser::findOrFail($trainingUserId);

        // store the file in public/assessments
        $assessmentPath = $request->file('assessment')->store('assessments', 'public');

        // update the training user with the assessment path
        $trainingUser->update([
            'assessment' => $assessmentPath,
        ]);

        // redirect back with success message
        return back()->with('success', 'Assessment uploaded successfully.');
    }

//    delete the assessment image
    public function destroy(TrainingUser $trainingUser)
    {
        if ($trainingUser->assessment && Storage::disk('public')->exists($trainingUser->assessment)) {
            Storage::disk('public')->delete($trainingUser->assessment);
        }

        // delete the assessment image
        $trainingUser->update([
            'assessment' => null,
        ]);

        //  redirect the user and send a success message
        return back()->with('success', 'Assessment deleted successfully.');
    }
}
