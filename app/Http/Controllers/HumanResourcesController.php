<?php

namespace App\Http\Controllers;

use App\Models\Job;

class HumanResourcesController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->jobOpenings()
            ->orderByDesc('created_at')
            ->get();

        return view('pages.human_resources', compact('jobs'));
    }
}
