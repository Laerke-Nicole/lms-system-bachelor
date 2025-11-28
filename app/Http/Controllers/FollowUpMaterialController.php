<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\FollowUpMaterial;
use Illuminate\Http\Request;

class FollowUpMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $followUpMaterials = $course->followUpMaterials()->latest()->paginate(5);

        return view('courses.follow_up_materials.index', compact('course', 'followUpMaterials'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $types = ['Video', 'Article', 'Book', 'Document', 'Other'];

        return view('courses.follow_up_materials.create', compact('course', 'types'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // create a new follow up material in the db
        $course->followUpMaterials()->create($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.follow_up_materials.index', $course)->with('success', 'Follow up material created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, FollowUpMaterial $followUpMaterial)
    {
        $types = ['Video', 'Article', 'Book', 'Document', 'Other'];

        return view('courses.follow_up_materials.edit', compact('course', 'followUpMaterial', 'types'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, FollowUpMaterial $followUpMaterial)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // update a new follow up material in the db
        $followUpMaterial->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.follow_up_materials.index', $course)->with('success', 'Follow up material updated successfully.');
    }


    /**
     * Remove the follow up material based on the id from the db.
     *
     * @param  \App\Models\FollowUpMaterial  $followUpMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, FollowUpMaterial $followUpMaterial)
    {
        // delete the follow up material from the db
        $followUpMaterial->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.follow_up_materials.index', $course)->with('success', 'Follow up material deleted successfully.');
    }
}
