<?php

namespace App\Http\Controllers;

use App\Models\Professional_course;
use App\Models\Course;
use App\Models\Professional;
use Illuminate\Http\Request;

class Professional_CourseController extends Controller
{

    public function edit(Professional_course $professional_course)
    {
        $professional_course->load('professional', 'course');
        
        return view('courses.edit_assigment', [
            'assignment' => $professional_course,
            'professional' => $professional_course->professional,
            'course' => $professional_course->course
        ]);
    }


    public function update(Request $request, Professional_course $professional_course)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'certificate' => 'required|string|max:50',
        ]);
        
        $professional_course->update($validated);
        
        return redirect()->route('course.assign_professional', $professional_course->course_id)
            ->with('success', 'Assignació actualitzada correctament');
    }
    
    public function destroy(Professional_course $professional_course)
    {
        $course_id = $professional_course->course_id;
        $professional_course->delete();
        
        return redirect()->route('course.assign_professional', $course_id)
            ->with('success', 'Assignació eliminada correctament');
    }
}