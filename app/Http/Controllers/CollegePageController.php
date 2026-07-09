<?php

namespace App\Http\Controllers;

use App\Models\CollegePage;
<<<<<<< HEAD

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
=======
use Illuminate\Http\Request;

class CollegePageController extends Controller
{
    public function showPublic($college)
    {
        $collegePage = CollegePage::where('college', $college)->firstOrFail();
        return view('pages.academics_public', compact('collegePage'));
    }
}
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
