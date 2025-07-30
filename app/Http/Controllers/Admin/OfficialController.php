<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Official;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officials = Official::orderBy('order')->get();
        return view('admin.officials.index', compact('officials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.officials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|array',
            'social_links.*' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = uniqid('official_') . '.' . $image->getClientOriginalExtension();

            // Create directory if it doesn't exist
            $directory = public_path('storage/photos/officials');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Simple file upload without image processing
            $image->move($directory, $filename);
            $data['photo'] = 'photos/officials/' . $filename;
        }

        if (isset($data['social_links'])) {
            $data['social_links'] = json_encode($data['social_links']);
        }

        Official::create($data);
        return redirect()->route('admin.officials.index')->with('success', 'Official created successfully.');
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
        $official = Official::findOrFail($id);
        return view('admin.officials.edit', compact('official'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $official = Official::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|array',
            'social_links.*' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = uniqid('official_') . '.' . $image->getClientOriginalExtension();

            // Create directory if it doesn't exist
            $directory = public_path('storage/photos/officials');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Delete old photo if exists
            if ($official->photo && file_exists(public_path('storage/' . $official->photo))) {
                unlink(public_path('storage/' . $official->photo));
            }

            // Simple file upload without image processing
            $image->move($directory, $filename);
            $data['photo'] = 'photos/officials/' . $filename;
        }

        if (isset($data['social_links'])) {
            $data['social_links'] = json_encode($data['social_links']);
        }

        $official->update($data);
        return redirect()->route('admin.officials.index')->with('success', 'Official updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $official = Official::findOrFail($id);
        $official->delete();
        return redirect()->route('admin.officials.index')->with('success', 'Official deleted successfully.');
    }
}
