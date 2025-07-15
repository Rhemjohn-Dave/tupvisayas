<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Official;
use App\Models\CarouselImage;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::orderBy('order')->get();
        $news = News::orderBy('created_at', 'desc')->limit(3)->get();
        $events = Event::orderBy('created_at', 'desc')->limit(3)->get();
        $announcements = Announcement::orderBy('created_at', 'desc')->limit(3)->get();
        $jobs = Job::orderBy('created_at', 'desc')->limit(3)->get();
        $officials_preview = Official::orderBy('order')->limit(3)->get();

        // Merge news, events, and announcements into a single collection
        $latestUpdates = collect();
        foreach ($news as $item) {
            $item->type = 'News';
            $latestUpdates->push($item);
        }
        foreach ($events as $item) {
            $item->type = 'Event';
            $latestUpdates->push($item);
        }
        foreach ($announcements as $item) {
            $item->type = 'Announcement';
            $latestUpdates->push($item);
        }
        $latestUpdates = $latestUpdates->sortByDesc('created_at')->values();

        return view('pages.home', compact('carouselImages', 'news', 'events', 'announcements', 'jobs', 'officials_preview', 'latestUpdates'));
    }
}
