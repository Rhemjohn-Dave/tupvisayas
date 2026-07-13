<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CollegePage;
use App\Models\Department;
use App\Models\Faculty;

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
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'description' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'facilities_labs' => 'nullable|string',
            'accreditation_info' => 'nullable|string',
            'board_performance' => 'nullable|string',
            'scholarships' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);
        if (empty($data['slug'])) {
            unset($data['slug']);
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('course_logos', 'public');
        }
        $course = Course::create($data);
        // Auto-create or link department to this course
        $department = Department::firstOrCreate([
            'college_page_id' => $data['college_page_id'],
            'name' => $data['name'],
        ]);
        if ($department->course_id !== $course->id) {
            $department->course_id = $course->id;
            $department->save();
        }
        return redirect()
            ->to(route('admin.college-pages.edit', $data['college_page_id']) . '?tab=admin-college-courses')
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
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'facilities_labs' => 'nullable|string',
            'accreditation_info' => 'nullable|string',
            'board_performance' => 'nullable|string',
            'scholarships' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);
        if (! array_key_exists('slug', $data) || $data['slug'] === null || $data['slug'] === '') {
            unset($data['slug']);
        }
        if ($request->hasFile('logo')) {
            if ($course->logo) {
                \Storage::disk('public')->delete($course->logo);
            }
            $data['logo'] = $request->file('logo')->store('course_logos', 'public');
        }
        $oldName = $course->name;
        $newName = $data['name'];

        // If the course name changed, rename or merge the matching department instead of creating a new one
        $deptToRename = Department::where('college_page_id', $course->college_page_id)
            ->where(function ($q) use ($course) {
                $q->where('course_id', $course->id)
                    ->orWhereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($course->name))]);
            })
            ->first();

        if ($deptToRename) {
            $targetDept = Department::where('college_page_id', $course->college_page_id)
                ->whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($newName))])
                ->first();

            if ($targetDept && $targetDept->id !== $deptToRename->id) {
                Faculty::where('department_id', $deptToRename->id)
                    ->update(['department_id' => $targetDept->id]);
                // keep the target linked to course
                if ($targetDept->course_id !== $course->id) {
                    $targetDept->course_id = $course->id;
                    $targetDept->save();
                }
                $deptToRename->delete();
            } else {
                $deptToRename->name = $newName;
                $deptToRename->course_id = $course->id;
                $deptToRename->save();
            }
        } else {
            // Ensure/create department and link it to this course
            $dept = Department::firstOrCreate([
                'college_page_id' => $course->college_page_id,
                'name' => $newName,
            ]);
            if ($dept->course_id !== $course->id) {
                $dept->course_id = $course->id;
                $dept->save();
            }
        }

        $course->update($data);

        return redirect()
            ->to(route('admin.college-pages.edit', $course->college_page_id) . '?tab=admin-college-courses')
            ->with('success', 'Course and department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $collegeId = $course->college_page_id;
        // Delete the corresponding Department linked by course_id (preferred) or by name as fallback
        $departments = Department::where('college_page_id', $collegeId)
            ->where(function ($q) use ($course) {
                $q->where('course_id', $course->id)
                    ->orWhereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($course->name))]);
            })
            ->get();
        foreach ($departments as $department) {
            $department->delete();
        }
        $course->delete();

        return redirect()
            ->to(route('admin.college-pages.edit', $collegeId) . '?tab=admin-college-courses')
            ->with('success', 'Course and related department deleted successfully.');
    }
}
