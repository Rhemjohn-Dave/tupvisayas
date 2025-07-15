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
        $categories = \App\Models\Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:news,announcement,job,event',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

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

    public function indexCategory()
    {
        $categories = \App\Models\Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        $slug = \Str::slug($request->name);
        \App\Models\Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }
}
