<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::get();
        return view('management_team.courses_management',['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management_team.course_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_forcem'   => 'required',
            'hours'         => 'required',
            'type'          => 'required',
            'mode'          => 'required',
            'training_name' => 'required',
        ]);
        $validated['center_id'] = session('center_id');
        $validated['status'] = 'active'; 
        Course::create($validated);
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('management_team.course_change',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'code_forcem'   => 'required',
            'hours'         => 'required',
            'type'          => 'required',
            'mode'          => 'required',
            'training_name' => 'required',
        ]);
        $validated['center_id'] = session('center_id');
        $validated['status'] = 'active'; 
        $course->update($validated);
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete(); // elimina el registro
        return redirect()->route('course.index');
    }

    public function activate(Course $course)
    {   
        $course->status = $course->status == 'active' ? 'inactive' : 'active';
        $course->save();
        return redirect()->route('course.index');
    }
}
