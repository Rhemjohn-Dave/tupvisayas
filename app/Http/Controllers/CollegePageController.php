<?php

namespace App\Http\Controllers;

use App\Models\CollegePage;

class CollegePageController extends Controller
{
    private const SLUG_MAP = [
        'coe' => 'College of Engineering',
        'coac' => 'College of Automation and Control',
        'coet' => 'College of Engineering Technology',
    ];

    public function showPublic($college)
    {
        $collegeName = self::SLUG_MAP[$college] ?? urldecode($college);

        $collegePage = CollegePage::where('college', $collegeName)
            ->with(['courses', 'studentOrganizations'])
            ->firstOrFail();

        return view('pages.academics_public', compact('collegePage'));
    }
}
