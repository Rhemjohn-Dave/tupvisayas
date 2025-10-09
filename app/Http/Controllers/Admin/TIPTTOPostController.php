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
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:t_i_p_t_t_o_posts,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();

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
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:t_i_p_t_t_o_posts,slug,' . $tipttoPost->id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();

        // Handle remove featured image
        if ($request->boolean('remove_featured_image')) {
            if ($tipttoPost->featured_image) {
                Storage::disk('public')->delete($tipttoPost->featured_image);
            }
            $data['featured_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($tipttoPost->featured_image) {
                Storage::disk('public')->delete($tipttoPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('tiptto_posts', 'public');
        }

        if ($data['is_published'] && !$tipttoPost->is_published) {
            $data['published_at'] = now();
        }

        $tipttoPost->update($data);

        return redirect()->route('admin.tiptto_posts.index')
            ->with('success', 'TIPTTO post updated successfully.');
    }

    public function destroy(TIPTTOPost $tipttoPost)
    {
        // Delete featured image if exists
        if ($tipttoPost->featured_image) {
            Storage::disk('public')->delete($tipttoPost->featured_image);
        }

        $tipttoPost->delete();

        return redirect()->route('admin.tiptto_posts.index')
            ->with('success', 'TIPTTO post deleted successfully.');
    }
}
