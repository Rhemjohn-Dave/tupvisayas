<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TIPTTOPost;

class ADREController extends Controller
{
    public function index()
    {
        $posts = TIPTTOPost::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('pages.tiptto', compact('posts'));
    }

    public function showPost($slug)
    {
<<<<<<< HEAD
        $post = TIPTTOPost::with('author')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedPosts = TIPTTOPost::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('pages.tiptto_post_show', compact('post', 'relatedPosts'));
=======
        $post = TIPTTOPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.tiptto_post_show', compact('post'));
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    }
}
