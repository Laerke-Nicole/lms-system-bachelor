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
    public function viewCertificate($training_id)
    {
        $certificate = Certificate::where('user_id', auth()->id())
            ->where('training_id', $training_id)
            ->firstOrFail();

        $abInventech = AbInventech::first();

        return view('certificates.certificate', compact('certificate', 'abInventech'));
    }

    public function showCertificate($training_id)
    {
        $certificate = Certificate::where('user_id', auth()->id())
            ->where('training_id', $training_id)
            ->firstOrFail();

        $abInventech = AbInventech::first();

        $data = [
            'title'     => 'Certificate',
            'subtitle'  => 'of completion',
            'presented' => 'presented to',
            'certificate' => $certificate,
            'abInventech' => $abInventech,
        ];

        $pdf = Pdf::loadView('certificates.showCertificate', $data);

//        pdf file name
        return $pdf->download('certificate_for_'.$certificate->training->course->title.'.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function certificates()
    {
        $certificates = Certificate::where('user_id', auth()->id())->latest()->paginate(5);
        return view('auth.profiles.certificates', compact('certificates'))->with(request()->input('page'));
    }
}
