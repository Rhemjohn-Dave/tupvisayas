<?php

namespace App\Http\Controllers;

use App\Models\CollegePage;
use Illuminate\Http\Request;

class CollegePageController extends Controller
{
    public function showPublic($college)
    {
        $collegePage = CollegePage::where('college', $college)->firstOrFail();
        return view('pages.academics_public', compact('collegePage'));
    }
}