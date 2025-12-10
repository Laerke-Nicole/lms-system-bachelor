<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Signature;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
//    first user chooses the way to submit their signature
    public function choose(TrainingUser $trainingUser)
    {
        return view('signatures.choose', compact('trainingUser'));
    }

//    if they wish to sign digitally
    public function digitalForm(TrainingUser $trainingUser)
    {
        $this->authorizedAccess($trainingUser);

        return view('signatures.digital', compact('trainingUser'));
    }

    public function digitalSubmit(Request $request, TrainingUser $trainingUser)
    {
        // validate the user input
        $request->validate([
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature_confirmed' => 'accepted',
        ]);

        $signaturePath = $request->file('signature_image')->store('signature_image', 'public');

        // create the certificate
        $certificate = Certificate::create([
            'training_user_id' => $trainingUser->id,
            'vestas_format' => false,
        ]);

        Signature::create([
            'training_user_id' => $trainingUser->id,
            'certificate_id' => $certificate->id,
            'signature_image' => $signaturePath,
            'signature_confirmed' => true,
            'signed_at' => now(),
        ]);

        return redirect()->route('certificates.viewCertificate', $trainingUser->training_id)->with('success', 'Congratulations! Your certificate is ready to download. You can always find your certificates in your profile.');
    }

    //    if they wish to sign printed
    public function printedForm(TrainingUser $trainingUser)
    {
        $this->authorizedAccess($trainingUser);

        return view('signatures.printed', compact('trainingUser'));
    }

    public function printedSubmit(Request $request, TrainingUser $trainingUser)
    {
        // validate the user input
        $validated = $request->validate([
            'signed_certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature_confirmed' => 'accepted',
        ]);

        $signaturePath = $request->file('signed_certificate')->store('signed_certificate', 'public');

        // create the certificate
        $certificate = Certificate::create([
            'training_user_id' => $trainingUser->id,
            'vestas_format' => false,
        ]);

        Signature::create([
            'training_user_id' => $trainingUser->id,
            'certificate_id' => $certificate->id,
            'signed_certificate_pdf' => $signaturePath,
            'signature_confirmed' => true,
            'signed_at' => now(),
        ]);

        return redirect()->route('certificates.viewCertificate', $trainingUser->training_id)->with('success', 'Congratulations! Your certificate is ready to download. You can always find your certificates in your profile.');
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

//        if the user already signed
        if ($trainingUser->certificate()->exists()) {
            abort(403, 'You have already signed the training.');
        }
    }
}
