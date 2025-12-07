<?php

namespace App\Http\Controllers;

use App\Models\AbInventech;
use App\Models\Certificate;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function certificate($training_id)
    {
        $certificate = Certificate::where('user_id', auth()->id())
            ->where('training_id', $training_id)
            ->firstOrFail();

        $abInventech = AbInventech::first();

        return view('certificates.certificate', compact('certificate', 'abInventech'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::latest()->paginate(5);
        return view('profiles.certificates.index', compact('certificates'))->with(request()->input('page'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Certificate $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        return view('profiles.certificates.show', compact('certificate'));
    }
}
