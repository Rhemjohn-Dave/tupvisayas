<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        $category = null;

        if ($request->has('category')) {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $news = \App\Models\News::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
                $announcements = \App\Models\Announcement::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
            } else {
                $news = collect();
                $announcements = collect();
            }
        } else {
            $news = \App\Models\News::orderBy('created_at', 'desc')->get();
            $announcements = \App\Models\Announcement::orderBy('created_at', 'desc')->get();
        }

        return view('pages.news_events', compact('news', 'announcements', 'categories', 'category'));
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

        // Generate slug from title
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        \App\Models\News::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'News created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $categories = \App\Models\Category::all();
        return view('pages.news_show', compact('news', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = \App\Models\Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        // Update slug if title changed
        if ($news->title !== $request->title) {
            $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        }

        if ($request->hasFile('picture')) {
            // Delete old image if exists
            if ($news->picture) {
                \Storage::disk('public')->delete($news->picture);
            }
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->picture) {
            \Storage::disk('public')->delete($news->picture);
        }
        $news->delete();
        return redirect()->route('admin.dashboard')->with('success', 'News deleted successfully!');
    }
}
