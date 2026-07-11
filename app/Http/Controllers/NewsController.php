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
        $categories = \App\Models\Category::orderBy('name')->get();
        $category = null;
        $search = trim((string) $request->get('search', ''));

        if ($request->filled('category')) {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if (! $category) {
                $updates = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);

                return view('pages.news_events', compact('updates', 'categories', 'category', 'search'));
            }
        }

        $updates = \App\Support\ContentFeed::paginateUpdates(
            $category?->id,
            $search,
            12
        );

        return view('pages.news_events', compact('updates', 'categories', 'category', 'search'));
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

        // Generate slug from title with proper cleaning
        $cleanTitle = strip_tags($request->title);
        $cleanTitle = html_entity_decode($cleanTitle, ENT_QUOTES, 'UTF-8');
        $baseSlug = \Illuminate\Support\Str::slug($cleanTitle);

        if (empty($baseSlug)) {
            $baseSlug = 'news-' . time();
        }

        $slug = $baseSlug;
        $counter = 1;

        // Make sure slug is unique
        while (\App\Models\News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

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
        $search = trim((string) request('search', ''));

        return view('pages.news_show', compact('news', 'categories', 'search'));
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
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        // Update slug if title changed
        if ($news->title !== $request->title) {
            $cleanTitle = strip_tags($request->title);
            $cleanTitle = html_entity_decode($cleanTitle, ENT_QUOTES, 'UTF-8');
            $baseSlug = \Illuminate\Support\Str::slug($cleanTitle);

            if (empty($baseSlug)) {
                $baseSlug = 'news-' . $news->id;
            }

            $slug = $baseSlug;
            $counter = 1;

            // Make sure slug is unique (excluding current news item)
            while (\App\Models\News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $data['slug'] = $slug;
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