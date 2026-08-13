<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Official;
use App\Models\SitGalleryImage;
use App\Models\SitIndustryPartner;

class SitController extends Controller
{
    public function index()
    {
        $partners = SitIndustryPartner::active()->ordered()->get();
        $galleryImages = SitGalleryImage::active()->ordered()->get();
        $sitOfficer = Official::query()
            ->where('name', 'like', '%Pabalinas%')
            ->orderBy('order')
            ->first();
        $campusRecruitment = Job::query()
            ->campusRecruitment()
            ->orderByDesc('created_at')
            ->get();

        return view('pages.sit', compact('partners', 'galleryImages', 'sitOfficer', 'campusRecruitment'));
    }
}
