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
<<<<<<< HEAD
        $colleges = CollegePage::withCount('courses')
            ->orderBy('college')
            ->get();

=======
        $colleges = CollegePage::all();
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
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
<<<<<<< HEAD
=======
            'student_organization' => 'nullable|string',
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        ]);
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('college_covers', 'public');
        }
<<<<<<< HEAD
        $college = CollegePage::create($data);

        return redirect()
            ->route('admin.college-pages.edit', $college->id)
            ->with('success', 'College page created. Add courses and content below.');
=======
        CollegePage::create($data);
        return redirect()->route('admin.college-pages.index')->with('success', 'College page created successfully.');
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
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
<<<<<<< HEAD
        $college = CollegePage::with(['departments.faculties', 'courses', 'studentOrganizations'])->findOrFail($id);
=======
        $college = CollegePage::with(['departments.faculties', 'courses'])->findOrFail($id);
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        return view('admin.college_pages.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $college = CollegePage::findOrFail($id);
<<<<<<< HEAD
        $section = $request->input('section', 'info');
        $tab = $request->input('tab', 'admin-college-info');

        $data = match ($section) {
            'info' => $request->validate([
                'college' => 'required|string|max:255|unique:college_pages,college,' . $college->id,
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            ]),
            'history' => $request->validate([
                'history' => 'nullable|string',
            ]),
            default => abort(422),
        };

        if ($request->hasFile('cover_photo')) {
            if ($college->cover_photo) {
                Storage::disk('public')->delete($college->cover_photo);
            }
            $data['cover_photo'] = $request->file('cover_photo')->store('college_covers', 'public');
        }

        $college->update($data);

        $message = match ($section) {
            'info' => 'College information saved.',
            'history' => 'History saved.',
            default => 'College page updated.',
        };

        return redirect()
            ->to(route('admin.college-pages.edit', $college->id) . '?tab=' . urlencode($tab))
            ->with('success', $message);
=======
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
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $college = CollegePage::findOrFail($id);
        if ($college->cover_photo) {
            Storage::disk('public')->delete($college->cover_photo);
        }
        $college->delete();
        return redirect()->route('admin.college-pages.index')
            ->with('success', 'College page deleted successfully.');
    }
}
