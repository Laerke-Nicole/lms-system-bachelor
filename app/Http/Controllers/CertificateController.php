<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AbInventech;
use App\Models\Certificate;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
//    the view the user gets directed to after signing
    public function viewCertificate($training_id)
    {
//        get the traininguser info to get the signature
        $trainingUser = TrainingUser::where('user_id', auth()->id())
            ->where('training_id', $training_id)
            ->firstOrFail();

//        get the specific certicate for this training and this user
        $certificate = Certificate::where('training_user_id', $trainingUser->id)
            ->firstOrFail();

        $abInventech = AbInventech::first();

        return view('certificates.certificate', compact('certificate', 'abInventech', 'trainingUser'));
    }

//    the actual pdf of the certificate
    public function certificatePdf($training_id)
    {
//        get the traininguser info to get the signature
        $trainingUser = TrainingUser::where('user_id', auth()->id())
            ->where('training_id', $training_id)
            ->firstOrFail();

//        get the certificate for this training
        $certificate = Certificate::where('training_user_id', $trainingUser->id)
            ->firstOrFail();

        $abInventech = AbInventech::first();

        $data = [
            'title'     => 'Certificate',
            'subtitle'  => 'of completion',
            'presented' => 'presented to',
            'certificate' => $certificate,
            'abInventech' => $abInventech,
            'trainingUser' => $trainingUser,
        ];

        $pdf = Pdf::loadView('certificates.certificatePdf', $data);

//        pdf file name
        return $pdf->download('certificate_for_'.$certificate->trainingUser->training->course->title.'.pdf');
    }

    /**
     * Display of the users certificates on their profile
     *
     * @return \Illuminate\Http\Response
     */
    public function certificates()
    {
        $certificates = Certificate::whereHas('trainingUser', function($query) {
            $query->where('user_id', auth()->id());
        })->latest()->paginate(5);
        return view('auth.profiles.certificates', compact('certificates'))->with(request()->input('page'));
    }
}
