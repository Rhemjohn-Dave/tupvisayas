<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CollegePage;
use App\Models\Department;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $collegePageId = $request->query('college_page_id');
        $college = CollegePage::findOrFail($collegePageId);
        return view('admin.courses.create', compact('college'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'college_page_id' => 'required|exists:college_pages,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        // Auto-create department if not exists
        $department = Department::firstOrCreate([
            'college_page_id' => $data['college_page_id'],
            'name' => $data['name'],
        ]);
        $course = Course::create($data);
        return redirect()->route('admin.college-pages.edit', $data['college_page_id'])
            ->with('success', 'Course and department added/linked successfully.');
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
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $college = $course->collegePage;
        return view('admin.courses.edit', compact('course', 'college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        // Auto-create department if not exists
        $department = Department::firstOrCreate([
            'college_page_id' => $course->college_page_id,
            'name' => $data['name'],
        ]);
        $course->update($data);
        return redirect()->route('admin.college-pages.edit', $course->college_page_id)
            ->with('success', 'Course and department updated/linked successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $collegeId = $course->college_page_id;
        $course->delete();
        return redirect()->route('admin.college-pages.edit', $collegeId)
            ->with('success', 'Course deleted successfully.');
    }
}
