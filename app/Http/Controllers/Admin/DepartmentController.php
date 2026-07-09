<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
<<<<<<< HEAD
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

=======

class DepartmentController extends Controller
{
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $collegeId = $department->college_page_id;
        $department->delete();
<<<<<<< HEAD

        return redirect()
            ->to(route('admin.college-pages.edit', $collegeId) . '?tab=admin-college-dept')
            ->with('success', 'Department deleted successfully.');
    }
}
=======
        return redirect()->route('admin.college-pages.edit', $collegeId)
            ->with('success', 'Department deleted successfully.');
    }
}


>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
