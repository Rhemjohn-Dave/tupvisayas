<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegePage;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'college_page_id' => 'required|integer|exists:college_pages,id',
            'name' => 'required|string|max:255',
        ]);

        $college = CollegePage::findOrFail($data['college_page_id']);

        Department::create([
            'college_page_id' => $college->id,
            'name' => $data['name'],
            'course_id' => null,
        ]);

        return redirect()
            ->to(route('admin.college-pages.edit', $college->id) . '?tab=admin-college-dept')
            ->with('success', 'Department created.');
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'head_faculty_id' => 'nullable|integer|exists:faculties,id',
        ]);

        if (! empty($data['head_faculty_id'])) {
            $belongs = Faculty::where('id', $data['head_faculty_id'])
                ->where('department_id', $department->id)
                ->exists();

            if (! $belongs) {
                return redirect()
                    ->to(route('admin.college-pages.edit', $department->college_page_id) . '?tab=admin-college-dept')
                    ->with('error', 'Program head must be a faculty member of this department.');
            }
        } else {
            $data['head_faculty_id'] = null;
        }

        $department->update($data);

        return redirect()
            ->to(route('admin.college-pages.edit', $department->college_page_id) . '?tab=admin-college-dept')
            ->with('success', 'Department updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $collegeId = $department->college_page_id;
        $department->delete();

        return redirect()
            ->to(route('admin.college-pages.edit', $collegeId) . '?tab=admin-college-dept')
            ->with('success', 'Department deleted successfully.');
    }
}
