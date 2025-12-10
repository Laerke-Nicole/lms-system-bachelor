<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function index(Request $request)
    {
        // make sure the training id exists on this user
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
        ]);

        $trainingUser = TrainingUser::where('user_id', auth()->id())
            ->where('training_id', $request->training_id)
            ->firstOrFail();

//        if the user hasn't completed the evaluation
        if (!$trainingUser->completed_evaluation_at) {
            abort(403, 'You must complete the evaluation before you can sign.');
        }

//        if the user already signed
        if ($trainingUser->signed_at) {
            abort(403, 'You have already signed the training.');
        }

        return view('signatures.index', compact('trainingUser'));
    }

    public function sign(Request $request, $trainingUserId)
    {
        // validate the user input
        $validated = $request->validate([
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature_confirmed' => 'accepted',
        ]);

//        only signed in users belonging to this training id can sign
        $trainingUser = TrainingUser::where('id', $trainingUserId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($request->hasFile('signature_image')) {
            $imagePath = $request->file('signature_image')->store('signatures', 'public');
            $validated['signature_image'] = $imagePath;
        }

        // store the time now as signed at
        $trainingUser->update([
            'signature' => $validated['signature'],
            'signature_confirmed' => true,
            'signed_at' => now(),
        ]);

        Certificate::create([
            'user_id' => auth()->id(),
            'training_id' => $trainingUser->training_id,
            'date' => now(),
        ]);

        return redirect()->route('certificates.viewCertificate', $trainingUser->training_id)->with('success', 'Congratulations! Your certificate is ready to download. You can always find your certificates in your profile.');
    }
}
