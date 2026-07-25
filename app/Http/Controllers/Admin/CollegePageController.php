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
        $colleges = CollegePage::withCount('courses')
            ->orderBy('college')
            ->get();

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
        ]);
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('college_covers', 'public');
        }
        $college = CollegePage::create($data);

        return redirect()
            ->route('admin.college-pages.edit', $college->id)
            ->with('success', 'College page created. Add courses and content below.');
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
        $college = CollegePage::with(['departments.faculties', 'courses'])->findOrFail($id);
        return view('admin.college_pages.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $college = CollegePage::findOrFail($id);
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
            'board_exam_ratings' => $request->validate([
                'board_exam_ratings' => 'nullable|string',
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
            'board_exam_ratings' => 'Board exam ratings saved.',
            default => 'College page updated.',
        };

        return redirect()
            ->to(route('admin.college-pages.edit', $college->id) . '?tab=' . urlencode($tab))
            ->with('success', $message);
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
