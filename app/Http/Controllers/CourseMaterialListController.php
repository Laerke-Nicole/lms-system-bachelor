<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Training;
use Illuminate\Http\Request;

class CourseMaterialListController extends Controller
{
    public function courseMaterialList($id)
    {
        // Load the training with necessary relationships
        $training = Training::with(['trainingSlot.course.courseMaterials'])->findOrFail($id);
        $course = $training->trainingSlot->course;

        return view('components.sections.course-materials', compact('training', 'course'));
    }
}
