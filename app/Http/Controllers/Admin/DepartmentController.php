<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($data);

        return redirect()
            ->to(route('admin.college-pages.edit', $department->college_page_id) . '?tab=admin-college-dept')
            ->with('success', 'Department name updated.');
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
