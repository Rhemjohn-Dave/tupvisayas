<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\CarouselImage;
use App\Models\Event;
use App\Models\Job;
use App\Models\News;
use App\Models\Official;
use App\Models\Procurement;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::orderBy('order')->get();

        $news = News::orderByDesc('created_at')->limit(3)->get();
        $events = Event::orderByDesc('created_at')->limit(3)->get();
        $announcements = Announcement::orderByDesc('created_at')->limit(3)->get();
        $jobs = Job::query()->jobOpenings()->orderByDesc('created_at')->limit(1)->get();
        $officials_preview = Official::orderBy('order')->limit(4)->get();

        $latestUpdates = collect()
            ->merge($news->map(function ($item) {
                $item->type = 'News';

                return $item;
            }))
            ->merge($events->map(function ($item) {
                $item->type = 'Event';

                return $item;
            }))
            ->merge($announcements->map(function ($item) {
                $item->type = 'Announcement';

                return $item;
            }))
            ->sortByDesc('created_at')
            ->take(1)
            ->values();

        $bidOpportunities = Procurement::query()
            ->where('type', 'bid_opportunity')
            ->orderByDesc('posting_date')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $showTupstatHero = SiteSetting::tupstatHeroEnabled();

        return view('pages.home', compact(
            'carouselImages',
            'jobs',
            'officials_preview',
            'latestUpdates',
            'bidOpportunities',
            'showTupstatHero'
        ));
    }
}
