<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Evaluation;
use App\Models\FollowUpTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('crud.courses.index', compact('courses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.courses.create');
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'duration' => 'required|integer',
            'duration_months' => 'required|integer',
            'max_participants' => 'required|integer',
            'evaluation_link' => 'required|url|max:2048',
            'test_link' => 'required|url|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // create evaluation
        $evaluation = Evaluation::create([
            'evaluation_link' => $request->evaluation_link,
        ]);

        // create follow-up test
        $followUpTest = FollowUpTest::create([
            'test_link' => $request->test_link,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', config('filesystems.uploads'));
            $validated['image'] = $imagePath;
        }

        // add evaluation_id and follow_up_test_id to validated data
        $validated['evaluation_id'] = $evaluation->id;
        $validated['follow_up_test_id'] = $followUpTest->id;

        // create a new courses in the db
        Course::create($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('crud.courses.show', compact('course'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $course->load(['evaluation', 'followUpTest']);
        return view('crud.courses.edit', compact('course'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'duration' => 'required|integer',
            'duration_months' => 'required|integer',
            'max_participants' => 'required|integer',
            'evaluation_link' => 'required|url|max:2048',
            'test_link' => 'required|url|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // update evaluation
        if ($course->evaluation) {
            $course->evaluation->update([
                'evaluation_link' => $request->evaluation_link,
            ]);
        }

        // update follow-up test
        if ($course->followUpTest) {
            $course->followUpTest->update([
                'test_link' => $request->test_link,
            ]);
        }

        if ($request->hasFile('image')) {
            if ($course->image) {
                uploads_disk()->delete($course->image);
            }
            $imagePath = $request->file('image')->store('courses', config('filesystems.uploads'));
            $validated['image'] = $imagePath;
        }

        // update a new courses in the db
        $course->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }


    /**
     * Remove the courses based on the id from the db.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if ($course->image) {
            uploads_disk()->delete($course->image);
        }

        // delete the courses from the db
        $course->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
