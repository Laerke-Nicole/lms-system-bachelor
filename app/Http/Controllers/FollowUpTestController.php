<?php

namespace App\Http\Controllers;

use App\Models\FollowUpTest;
use Illuminate\Http\Request;

class FollowUpTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followUpTests = FollowUpTest::latest()->paginate(5);
        return view('follow_up_tests.index', compact('followUpTests'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('follow_up_tests.create');
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
            'test_link' => 'required|url',
        ]);

        // create a new follow up test in the db
        FollowUpTest:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('follow_up_tests.index')->with('success', 'Follow up test created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUpTest  $followUpTest
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUpTest $followUpTest)
    {
        return view('follow_up_tests.show', compact('followUpTest'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUpTest  $followUpTest
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUpTest $followUpTest)
    {
        return view('follow_up_tests.edit', compact('followUpTest'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUpTest  $followUpTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpTest $followUpTest)
    {
        // validate the user input
        $request->validate([
            'test_link' => 'required|url',
        ]);

        // update a new follow up test in the db
        $followUpTest->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('follow_up_tests.index')->with('success', 'Follow up test updated successfully.');
    }


    /**
     * Remove the follow up test based on the id from the db.
     *
     * @param  \App\Models\FollowUpTest  $followUpTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpTest $followUpTest)
    {
        // delete the follow up test from the db
        $followUpTest->delete();

        //  redirect the user and send a success message
        return redirect()->route('follow_up_tests.index')->with('success', 'Follow up test deleted successfully.');
    }
}
