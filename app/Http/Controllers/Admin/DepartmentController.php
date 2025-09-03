<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $collegeId = $department->college_page_id;
        $department->delete();
        return redirect()->route('admin.college-pages.edit', $collegeId)
            ->with('success', 'Department deleted successfully.');
    }
}


