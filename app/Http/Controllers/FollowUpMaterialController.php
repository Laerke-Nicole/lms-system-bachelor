<?php

namespace App\Http\Controllers;

use App\Models\FollowUpMaterial;
use Illuminate\Http\Request;

class FollowUpMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followUpMaterials = FollowUpMaterial::latest()->paginate(5);
        return view('follow_up_materials.index', compact('followUpMaterials'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('follow_up_materials.create');
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
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // create a new follow up material in the db
        FollowUpMaterial:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('follow_up_materials.index')->with('success', 'Follow up material created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUpMaterial $followUpMaterial)
    {
        return view('follow_up_materials.show', compact('followUpMaterial'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUpMaterial $followUpMaterial)
    {
        return view('follow_up_materials.edit', compact('followUpMaterial'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpMaterial $followUpMaterial)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // update a new follow up material in the db
        $followUpMaterial->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('follow_up_materials.index')->with('success', 'Follow up material updated successfully.');
    }


    /**
     * Remove the follow up material based on the id from the db.
     *
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpMaterial $followUpMaterial)
    {
        // delete the follow up material from the db
        $followUpMaterial->delete();

        //  redirect the user and send a success message
        return redirect()->route('follow_up_materials.index')->with('success', 'Follow up material deleted successfully.');
    }
}
