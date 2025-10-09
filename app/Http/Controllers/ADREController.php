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
        $post = TIPTTOPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.tiptto_post_show', compact('post'));
    }
}
