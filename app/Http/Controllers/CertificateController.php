<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::latest()->paginate(5);
        return view('certificates.index', compact('certificates'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('certificates.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'valid_until' => 'required|date',
        ]);

        // create a new certificate in the db
        Certificate:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('certificates.index')->with('success', 'Certificate created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        return view('certificates.show', compact('certificate'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        return view('certificates.edit', compact('certificate'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'valid_until' => 'required|date',
        ]);

        // update a new certificate in the db
        $certificate->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('certificates.index')->with('success', 'Certificate updated successfully.');
    }


    /**
     * Remove the certificate based on the id from the db.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        // delete the certificate from the db
        $certificate->delete();

        //  redirect the user and send a success message
        return redirect()->route('certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
