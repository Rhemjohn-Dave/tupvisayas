<?php

namespace App\Http\Controllers;

use App\Models\DirectorPost;
use App\Models\Official;
use Illuminate\Http\Request;

class DirectorCornerController extends Controller
{
    public function index(Request $request)
    {
        $director = Official::query()
            ->where('position', 'like', '%Director%')
            ->where('position', 'not like', '%Assistant%')
            ->orderBy('order')
            ->first();

        $type = $request->query('type');
        if (!in_array($type, ['blog', 'news'], true)) {
            $type = null;
        }

        $posts = DirectorPost::query()
            ->where('is_published', true)
            ->when($type, fn ($query) => $query->where('type', $type))
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(6)
            ->withQueryString();

        return view('pages.directors_corner', compact('director', 'posts', 'type'));
    }

    public function show(string $slug)
    {
        $post = DirectorPost::with('author')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $director = Official::query()
            ->where('position', 'like', '%Director%')
            ->where('position', 'not like', '%Assistant%')
            ->orderBy('order')
            ->first();

        $relatedPosts = DirectorPost::query()
            ->where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('type', $post->type)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('pages.director_post_show', compact('post', 'director', 'relatedPosts'));
    }
}
