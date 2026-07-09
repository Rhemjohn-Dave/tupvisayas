<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DirectorPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DirectorPostController extends Controller
{
    public function index()
    {
        $posts = DirectorPost::with('author')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.director_posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.director_posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:director_posts,slug',
            'type' => 'required|in:blog,news',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'is_published' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => $this->resolveSlug($validated['slug'] ?? null, $validated['title']),
            'type' => $validated['type'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'author_id' => auth()->id(),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('director_posts', 'public');
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        DirectorPost::create($data);

        return redirect()->route('admin.director_posts.index')
            ->with('success', 'Director\'s Corner post created successfully.');
    }

    public function edit(DirectorPost $directorPost)
    {
        return view('admin.director_posts.edit', compact('directorPost'));
    }

    public function update(Request $request, DirectorPost $directorPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:director_posts,slug,' . $directorPost->id,
            'type' => 'required|in:blog,news',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'is_published' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->filled('slug')) {
            $data['slug'] = $this->resolveSlug($validated['slug'], $validated['title'], $directorPost->id);
        } elseif (!$directorPost->slug) {
            $data['slug'] = $this->resolveSlug(null, $validated['title'], $directorPost->id);
        }

        if ($request->boolean('remove_featured_image')) {
            if ($directorPost->featured_image) {
                Storage::disk('public')->delete($directorPost->featured_image);
            }
            $data['featured_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($directorPost->featured_image) {
                Storage::disk('public')->delete($directorPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('director_posts', 'public');
        }

        if ($data['is_published'] && !$directorPost->is_published) {
            $data['published_at'] = now();
        }

        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        $directorPost->update($data);

        return redirect()->route('admin.director_posts.index')
            ->with('success', 'Director\'s Corner post updated successfully.');
    }

    public function destroy(DirectorPost $directorPost)
    {
        if ($directorPost->featured_image) {
            Storage::disk('public')->delete($directorPost->featured_image);
        }

        $directorPost->delete();

        return redirect()->route('admin.director_posts.index')
            ->with('success', 'Director\'s Corner post deleted successfully.');
    }

    private function resolveSlug(?string $slug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug ?: $title) ?: 'post';
        $candidate = $base;
        $counter = 1;

        while (
            DirectorPost::when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $base . '-' . $counter++;
        }

        return $candidate;
    }
}
