<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegePage;
use App\Models\StudentOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentOrganizationController extends Controller
{
    public function create(Request $request)
    {
        $college = CollegePage::findOrFail($request->query('college_page_id'));

        return view('admin.student_organizations.create', compact('college'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'college_page_id' => 'required|exists:college_pages,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('student_org_logos', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        StudentOrganization::create($data);

        return redirect()
            ->to(route('admin.college-pages.edit', $data['college_page_id']) . '?tab=admin-college-org')
            ->with('success', 'Student organization added.');
    }

    public function edit($student_organization)
    {
        $organization = StudentOrganization::with('collegePage')->findOrFail($student_organization);
        $college = $organization->collegePage;

        return view('admin.student_organizations.edit', compact('organization', 'college'));
    }

    public function update(Request $request, $student_organization)
    {
        $organization = StudentOrganization::findOrFail($student_organization);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
            $data['logo'] = $request->file('logo')->store('student_org_logos', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        $organization->update($data);

        return redirect()
            ->to(route('admin.college-pages.edit', $organization->college_page_id) . '?tab=admin-college-org')
            ->with('success', 'Student organization updated.');
    }

    public function destroy($student_organization)
    {
        $organization = StudentOrganization::findOrFail($student_organization);
        $collegeId = $organization->college_page_id;

        if ($organization->logo) {
            Storage::disk('public')->delete($organization->logo);
        }

        $organization->delete();

        return redirect()
            ->to(route('admin.college-pages.edit', $collegeId) . '?tab=admin-college-org')
            ->with('success', 'Student organization deleted.');
    }
}
