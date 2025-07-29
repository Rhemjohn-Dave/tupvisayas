<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollegePage;
use Illuminate\Support\Facades\Storage;

class CollegePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colleges = CollegePage::all();
        return view('admin.college_pages.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.college_pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'college' => 'required|string|unique:college_pages,college',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'history' => 'nullable|string',
            'department_faculty' => 'nullable|string',
            'student_organization' => 'nullable|string',
        ]);
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('college_covers', 'public');
        }
        CollegePage::create($data);
        return redirect()->route('admin.college-pages.index')->with('success', 'College page created successfully.');
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
        $college = CollegePage::findOrFail($id);
        return view('admin.college_pages.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $college = CollegePage::findOrFail($id);
        $data = $request->validate([
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'history' => 'nullable|string',
            'department_faculty' => 'nullable|string',
            'student_organization' => 'nullable|string',
        ]);
        if ($request->hasFile('cover_photo')) {
            // Delete old photo if exists
            if ($college->cover_photo) {
                Storage::disk('public')->delete($college->cover_photo);
            }
            $path = $request->file('cover_photo')->store('college_covers', 'public');
            $data['cover_photo'] = $path;
        }
        $college->update($data);
        return redirect()->route('admin.college-pages.index')->with('success', 'College page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
