<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class FacultyController extends Controller
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
        $departmentId = $request->query('department_id');
        $department = Department::findOrFail($departmentId);
        return view('admin.faculties.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'rank' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('faculty_photos', 'public');
        }
        $faculty = Faculty::create($data);
        $collegeId = $faculty->department->college_page_id;
        return redirect()->route('admin.college-pages.edit', $collegeId)
            ->with('success', 'Faculty added successfully.');
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
        $faculty = Faculty::findOrFail($id);
        $department = $faculty->department;
        return view('admin.faculties.edit', compact('faculty', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $faculty = Faculty::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rank' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
        if ($request->hasFile('photo')) {
            if ($faculty->photo) {
                Storage::disk('public')->delete($faculty->photo);
            }
            $data['photo'] = $request->file('photo')->store('faculty_photos', 'public');
        }
        $faculty->update($data);
        $collegeId = $faculty->department->college_page_id;
        return redirect()->route('admin.college-pages.edit', $collegeId)
            ->with('success', 'Faculty updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faculty = Faculty::findOrFail($id);
        $collegeId = $faculty->department->college_page_id;
        if ($faculty->photo) {
            Storage::disk('public')->delete($faculty->photo);
        }
        $faculty->delete();
        return redirect()->route('admin.college-pages.edit', $collegeId)
            ->with('success', 'Faculty deleted successfully.');
    }
}
