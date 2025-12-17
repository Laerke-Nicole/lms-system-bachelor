<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $courseMaterials = $course->courseMaterials()->latest()->paginate(5);

        return view('crud.courses.course_materials.index', compact('course', 'courseMaterials'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $materialTypes = ['Preparation', 'Follow up'];
        $types = ['Video', 'PDF', 'Task', 'Quiz', 'Other'];

        return view('crud.courses.course_materials.create', compact('course', 'materialTypes', 'types'));
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
            'url' => 'nullable|url',
            'pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('courses', 'public');
            $validated['pdf'] = $pdfPath;
        }

        // create a new course material in the db
        $course->courseMaterials()->create($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.course_materials.index', $course)->with('success', 'Course material created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, CourseMaterial $courseMaterial)
    {
        $materialTypes = ['Preparation', 'Follow up'];
        $types = ['Video', 'PDF', 'Task', 'Quiz', 'Other'];

        return view('crud.courses.course_materials.edit', compact('course', 'courseMaterial', 'materialTypes', 'types'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, CourseMaterial $courseMaterial)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'nullable|url',
            'pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('pdf')) {
            if ($courseMaterial->pdf) {
                Storage::delete('public/' . $courseMaterial->pdf);
            }
            $pdfPath = $request->file('pdf')->store('courseMaterials', 'public');
            $validated['pdf'] = $pdfPath;
        }

        // update a new course material in the db
        $courseMaterial->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.course_materials.index', $course)->with('success', 'Course material updated successfully.');
    }


    /**
     * Remove the course material based on the id from the db.
     *
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, CourseMaterial $courseMaterial)
    {
        // delete the course material from the db
        $courseMaterial->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.course_materials.index', $course)->with('success', 'Course material deleted successfully.');
    }
}
