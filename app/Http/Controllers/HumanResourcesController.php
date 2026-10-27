<?php

namespace App\Http\Controllers;

use App\Models\HrPost;
use App\Models\Job;

class HumanResourcesController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->jobOpenings()
            ->orderByDesc('created_at')
            ->get();

        $announcements = HrPost::query()
            ->published()
            ->announcements()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        $programs = HrPost::query()
            ->published()
            ->programs()
            ->with('department')
            ->orderByDesc('event_date')
            ->orderByDesc('published_at')
            ->limit(12)
            ->get();

        return view('pages.human_resources', compact('jobs', 'announcements', 'programs'));
    }

    public function show(HrPost $hrPost)
    {
        abort_unless($hrPost->is_published, 404);

        $hrPost->loadMissing(['department', 'author']);

        $relatedQuery = HrPost::query()
            ->published()
            ->where('id', '!=', $hrPost->id);

        if ($hrPost->isProgram()) {
            $relatedPosts = $relatedQuery
                ->programs()
                ->with('department')
                ->orderByDesc('event_date')
                ->limit(4)
                ->get();
        } else {
            $relatedPosts = $relatedQuery
                ->announcements()
                ->orderByDesc('published_at')
                ->limit(4)
                ->get();
        }

        return view('pages.hr_post_show', compact('hrPost', 'relatedPosts'));
    }
}
