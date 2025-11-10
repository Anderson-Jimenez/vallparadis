<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Professional;
use App\Models\Professional_course;

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

    public function assign_professional(Course $course){
        $professionals = Professional::get();
        return view('management_team.course_assign_professional',['course'=>$course, 'professionals'=>$professionals]);
    }

    public function assign_professional_to_course(Request $request){
        foreach($request->professionals as $prof_id){
            $validated['course_id'] = $request->course_id;
            $validated['professional_id'] = $prof_id;
            $validated['start_date'] = now();
            $validated['end_date'] = now();
            $validated['certificate'] = 'Pendent';
            Professional_course::create($validated);
        }
        return response()->json(['status' => 'ok','redirect' => route('course.index')]);
    }
}
