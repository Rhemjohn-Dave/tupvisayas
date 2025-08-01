<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        $category = null;
        $announcements = \App\Models\Announcement::query();

        // Handle category filtering
        if ($request->has('category') && $request->category !== '') {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $announcements->where('category_id', $category->id);
            }
        }

        // Handle search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $announcements->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $announcements = $announcements->with('category')->orderBy('created_at', 'desc')->get();

        return view('pages.announcements', compact('announcements', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        \App\Models\Announcement::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Announcement created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $categories = \App\Models\Category::all();
        return view('pages.announcement_show', compact('announcement', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $categories = \App\Models\Category::all();
        return view('admin.announcements.edit', compact('announcement', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        // Clear slug if title changed so model can regenerate it
        if ($announcement->title !== $request->title) {
            $data['slug'] = null;
        }

        if ($request->hasFile('picture')) {
            // Delete old image if exists
            if ($announcement->picture) {
                \Storage::disk('public')->delete($announcement->picture);
            }
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        $announcement->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Announcement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        if ($announcement->picture) {
            \Storage::disk('public')->delete($announcement->picture);
        }
        $announcement->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Announcement deleted successfully!');
    }
}
