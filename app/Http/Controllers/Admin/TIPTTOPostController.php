<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TIPTTOPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TIPTTOPostController extends Controller
{
    public function index()
    {
        $posts = TIPTTOPost::with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.tiptto_posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.tiptto_posts.create');
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $validated = $request->validate([
=======
        $request->validate([
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:t_i_p_t_t_o_posts,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
<<<<<<< HEAD
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'is_published' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => $this->resolveSlug($validated['slug'] ?? null, $validated['title']),
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'author_id' => auth()->id(),
            'is_published' => $request->boolean('is_published'),
        ];
=======
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('tiptto_posts', 'public');
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        TIPTTOPost::create($data);

        return redirect()->route('admin.tiptto_posts.index')
            ->with('success', 'TIPTTO post created successfully.');
    }

    public function show(TIPTTOPost $tipttoPost)
    {
        return view('admin.tiptto_posts.show', compact('tipttoPost'));
    }

    public function edit(TIPTTOPost $tipttoPost)
    {
        return view('admin.tiptto_posts.edit', compact('tipttoPost'));
    }

    public function update(Request $request, TIPTTOPost $tipttoPost)
    {
<<<<<<< HEAD
        $validated = $request->validate([
=======
        $request->validate([
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:t_i_p_t_t_o_posts,slug,' . $tipttoPost->id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
<<<<<<< HEAD
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'is_published' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->filled('slug')) {
            $data['slug'] = $this->resolveSlug($validated['slug'], $validated['title'], $tipttoPost->id);
        } elseif (!$tipttoPost->slug) {
            $data['slug'] = $this->resolveSlug(null, $validated['title'], $tipttoPost->id);
        }

=======
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();

        // Handle remove featured image
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        if ($request->boolean('remove_featured_image')) {
            if ($tipttoPost->featured_image) {
                Storage::disk('public')->delete($tipttoPost->featured_image);
            }
            $data['featured_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
<<<<<<< HEAD
=======
            // Delete old image
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            if ($tipttoPost->featured_image) {
                Storage::disk('public')->delete($tipttoPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('tiptto_posts', 'public');
        }

        if ($data['is_published'] && !$tipttoPost->is_published) {
            $data['published_at'] = now();
        }

<<<<<<< HEAD
        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

=======
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        $tipttoPost->update($data);

        return redirect()->route('admin.tiptto_posts.index')
            ->with('success', 'TIPTTO post updated successfully.');
    }

    public function destroy(TIPTTOPost $tipttoPost)
    {
<<<<<<< HEAD
=======
        // Delete featured image if exists
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        if ($tipttoPost->featured_image) {
            Storage::disk('public')->delete($tipttoPost->featured_image);
        }

        $tipttoPost->delete();

        return redirect()->route('admin.tiptto_posts.index')
            ->with('success', 'TIPTTO post deleted successfully.');
    }
<<<<<<< HEAD

    private function resolveSlug(?string $slug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug ?: $title) ?: 'post';
        $candidate = $base;
        $counter = 1;

        while (
            TIPTTOPost::when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $base . '-' . $counter++;
        }

        return $candidate;
    }
=======
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
}
