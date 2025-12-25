<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Signature;
use App\Models\TrainingUser;
use App\Notifications\NewCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
//    first user chooses the way to submit their signature
    public function choose(TrainingUser $trainingUser)
    {
        $this->authorizedAccess($trainingUser);

        return view('signatures.choose', compact('trainingUser'));
    }

//    if they wish to sign digitally
    public function digitalForm(TrainingUser $trainingUser)
    {
        $this->authorizedAccess($trainingUser);

        return view('signatures.digital.digital', compact('trainingUser'));
    }

    public function digitalImage(Request $request, TrainingUser $trainingUser)
    {
        $request->validate([
            'signature_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

//        save the temporary signature image
        $signaturePath = $request->file('signature_image')->store('signature_image/temp', 'public');

        $trainingUser->update([
            'temporary_signature' => $signaturePath,
        ]);

        return redirect()->route('signatures.digital.digital-confirm', $trainingUser);
    }

    public function digitalConfirm(TrainingUser $trainingUser)
    {
        $this->authorizedAccess($trainingUser);

//        if they dont have a temporary signature go back
        if (!$trainingUser->temporary_signature) {
            return redirect()->route('signatures.digital', $trainingUser)->with('error', 'Please upload your signature first.');
        }

        return view('signatures.digital.digital-confirm', compact('trainingUser'));
    }

    public function digitalSubmit(Request $request, TrainingUser $trainingUser)
    {
//        if they dont have a temporary signature go back
        if (!$trainingUser->temporary_signature) {
            return redirect()->route('signatures.digital.digital', $trainingUser)->with('error', 'Please upload your signature first.');
        }

//        replace the temporary signature with the real one
        $signature = str_replace('signatures/temp', 'signatures/final', $trainingUser->temporary_signature);
        Storage::disk('public')->move($trainingUser->temporary_signature, $signature);

        // create the certificate
        $certificate = Certificate::create([
            'training_user_id' => $trainingUser->id,
        ]);

//        create the signature
        Signature::create([
            'training_user_id' => $trainingUser->id,
            'certificate_id' => $certificate->id,
            'signature_image' => $signature,
            'signature_confirmed' => true,
            'signed_at' => now(),
        ]);

//        set the temporary signat
        $trainingUser->update([
            'temporary_signature' => null,
        ]);

//        send notification to the user and their leader when the certificate was made
        try {
            $courseName = $trainingUser->training->course->title;
            $trainingUser->user->notify(new NewCertificate($courseName, $trainingUser->user_id, $trainingUser->training_id));
            $trainingUser->training->orderedBy->notify(new NewCertificate($courseName, $trainingUser->user_id, $trainingUser->training_id));
        } catch (\Throwable $e) {
            \Log::error('Failed to send certificate notification: ' . $e->getMessage());
        }

        return redirect()->route('certificates.certificate-confirmation', $trainingUser->training_id)->with('success', 'Congratulations! Your certificate is ready to download. You can always find your certificates in your profile and in your trainings history.');
    }

    //    if they wish to sign printed
    public function printedForm(TrainingUser $trainingUser)
    {
        $this->authorizedAccess($trainingUser);

        return view('signatures.printed.printed', compact('trainingUser'));
    }

    public function printedSubmit(Request $request, TrainingUser $trainingUser)
    {
        // validate the user input
        $validated = $request->validate([
            'signed_certificate_image' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $signaturePath = $request->file('signed_certificate_image')->store('signed_certificate', 'public');

        // create the certificate
        $certificate = Certificate::firstOrCreate([
            'training_user_id' => $trainingUser->id,
        ]);

//        create the signature
        Signature::updateOrCreate([
            'training_user_id' => $trainingUser->id,
            'certificate_id' => $certificate->id,
            'signed_certificate_image' => $signaturePath,
            'signature_confirmed' => true,
            'signed_at' => now(),
        ]);

//        send notification to the user and their leader when the certificate was made
        try {
            $courseName = $trainingUser->training->course->title;
            $trainingUser->user->notify(new NewCertificate($courseName, $trainingUser->user_id, $trainingUser->training_id));
            $trainingUser->training->orderedBy->notify(new NewCertificate($courseName, $trainingUser->user_id, $trainingUser->training_id));
        } catch (\Throwable $e) {
            \Log::error('Failed to send certificate notification: ' . $e->getMessage());
        }

        return redirect()->route('certificates.certificate-confirmation', $trainingUser->training_id)->with('success', 'Congratulations! Your certificate is ready to download. You can always find your certificates in your profile.');
    }

//    store the checks for cleaner code
    public function authorizedAccess(TrainingUser $trainingUser)
    {
        //        if user isnt authed
        if ($trainingUser->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this training.');
        }

//        if the user hasn't completed the evaluation
        if (!$trainingUser->completed_evaluation_at) {
            abort(403, 'You must complete the evaluation before you can sign.');
        }

//        if the admin hasnt given the user their assessment evaluation yet
        if (!$trainingUser->assessment) {
            abort(403, 'You must wait for your assessment evaluation.');
        }

//        if the user already signed
        if ($trainingUser->certificate()->exists()) {
            abort(403, 'You have already signed the training.');
        }

        if ($trainingUser->signature && $trainingUser->signature->signature_confirmed) {
            abort(403, 'You have already signed the training.');
        }
    }
}
