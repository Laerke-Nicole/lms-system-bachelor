<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = Evaluation::latest()->paginate(5);
        return view('evaluations.index', compact('evaluations'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluations.create');
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
            'evaluation_link' => 'required|url',
        ]);

        // create a new evaluation in the db
        Evaluation:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('evaluations.index')->with('success', 'Evaluation created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        return view('evaluations.show', compact('evaluation'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', compact('evaluation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'evaluation_link' => 'required|url',
        ]);

        // update a new evaluation in the db
        $evaluation->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('evaluations.index')->with('success', 'Evaluation updated successfully.');
    }


    /**
     * Remove the evaluation based on the id from the db.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        // delete the evaluation from the db
        $evaluation->delete();

        //  redirect the user and send a success message
        return redirect()->route('evaluations.index')->with('success', 'Evaluation deleted successfully.');
    }
}
