<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegePage;
use App\Models\Official;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::query()
            ->with('collegePage')
            ->orderBy('order')
            ->get();

        return view('admin.officials.index', compact('officials'));
    }

    public function create()
    {
        $colleges = CollegePage::orderBy('college')->get();

        return view('admin.officials.create', compact('colleges'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote' => 'nullable|string|max:280',
            'order' => 'nullable|integer',
            'college_page_id' => 'nullable|exists:college_pages,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = uniqid('official_') . '.' . $image->getClientOriginalExtension();

            $directory = public_path('storage/photos/officials');
            if (! file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->move($directory, $filename);
            $data['photo'] = 'photos/officials/' . $filename;
        }

        Official::create($data);

        return redirect()->route('admin.officials.index')->with('success', 'Official created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $official = Official::findOrFail($id);
        $colleges = CollegePage::orderBy('college')->get();

        return view('admin.officials.edit', compact('official', 'colleges'));
    }

    public function update(Request $request, $id)
    {
        $official = Official::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote' => 'nullable|string|max:280',
            'order' => 'nullable|integer',
            'college_page_id' => 'nullable|exists:college_pages,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = uniqid('official_') . '.' . $image->getClientOriginalExtension();

            $directory = public_path('storage/photos/officials');
            if (! file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            if ($official->photo && file_exists(public_path('storage/' . $official->photo))) {
                unlink(public_path('storage/' . $official->photo));
            }

            $image->move($directory, $filename);
            $data['photo'] = 'photos/officials/' . $filename;
        }

        $official->update($data);

        return redirect()->route('admin.officials.index')->with('success', 'Official updated successfully.');
    }

    public function destroy($id)
    {
        $official = Official::findOrFail($id);
        $official->delete();

        return redirect()->route('admin.officials.index')->with('success', 'Official deleted successfully.');
    }
}
