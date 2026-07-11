<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = \App\Models\Job::orderBy('created_at', 'desc')->paginate(12);

        return view('pages.jobs', compact('jobs'));
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
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        \App\Models\Job::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Job created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('pages.job_show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $categories = \App\Models\Category::all();
        return view('admin.jobs.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('picture')) {
            if ($job->picture) {
                \Storage::disk('public')->delete($job->picture);
            }
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        $job->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if ($job->picture) {
            \Storage::disk('public')->delete($job->picture);
        }
        $job->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Job deleted successfully!');
    }
}
