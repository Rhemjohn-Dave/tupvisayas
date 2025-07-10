<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = \App\Models\News::orderBy('created_at', 'desc')->get();
        $events = \App\Models\Event::orderBy('created_at', 'desc')->get();
        return view('pages.news_events', compact('news', 'events'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = \App\Models\News::findOrFail($id);
        return view('pages.news_show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

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
