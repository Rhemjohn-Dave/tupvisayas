<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Job;
use App\Models\Event;

class PostController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        $announcements = Announcement::latest()->get();
        $jobs = Job::latest()->get();
        $events = Event::latest()->get();

        return view('admin.dashboard', compact('news', 'announcements', 'jobs', 'events'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:news,announcement,job,event',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        switch ($request->type) {
            case 'news':
                \App\Models\News::create($data);
                break;
            case 'announcement':
                \App\Models\Announcement::create($data);
                break;
            case 'job':
                \App\Models\Job::create($data);
                break;
            case 'event':
                \App\Models\Event::create($data);
                break;
        }

        return redirect()->route('admin.dashboard')->with('success', 'Post created successfully!');
    }
}
