<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(5);
        return view('companies.index', compact('companies'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'company_name' => 'required',
            'company_mail' => 'required|email',
            'company_phone' => 'required',
        ]);

        // create a new company in the db
        Company:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        // validate the user input
        $request->validate([
            'company_name' => 'required',
            'company_mail' => 'required|email',
            'company_phone' => 'required',
        ]);

        // update a new company in the db
        $company->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }


    /**
     * Remove the company based on the id from the db.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // delete the company from the db
        $company->delete();

        //  redirect the user and send a success message
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
