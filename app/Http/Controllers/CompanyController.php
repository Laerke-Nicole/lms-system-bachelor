<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\PostalCode;
use App\Models\Address;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('address.postalCode')->latest()->paginate(5);
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
            'company_name' => 'required|string|max:255',
            'company_mail' => 'required|email|max:255',
            'company_phone' => 'required|string|max:50',
            'is_vestas' => 'nullable|boolean',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // create postal code
        $postalCode = PostalCode::create([
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        // create address including postal code id
        $address = Address::create([
            'street_name' => $request->street_name,
            'street_number' => $request->street_number,
            'postal_code_id' => $postalCode->id,
        ]);

        // create company including address id
        Company::create([
            'company_name' => $request->company_name,
            'company_mail' => $request->company_mail,
            'company_phone' => $request->company_phone,
            'is_vestas' => $request->has('is_vestas') ? 1 : 0,
            'address_id' => $address->id,
        ]);

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
        //        run one joined query
        $company->load('address.postalCode');
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
        //        run one joined query
        $company->load('address.postalCode');
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
            'company_name' => 'required|string|max:255',
            'company_mail' => 'required|email|max:255',
            'company_phone' => 'required|string|max:50',
            'is_vestas' => 'nullable|boolean',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // update postal code
        if ($company->address && $company->address->postalCode) {
            $company->address->postalCode->update([
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'country' => $request->country,
            ]);
        }

        // update address
        if ($company->address) {
            $company->address->update([
                'street_name' => $request->street_name,
                'street_number' => $request->street_number,
            ]);
        }

        // update company
        $company->update([
            'company_name' => $request->company_name,
            'company_mail' => $request->company_mail,
            'company_phone' => $request->company_phone,
            'is_vestas' => $request->has('is_vestas') ? 1 : 0,
        ]);

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
