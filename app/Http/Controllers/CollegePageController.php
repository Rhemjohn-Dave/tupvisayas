<?php

namespace App\Http\Controllers;

use App\Models\CollegePage;
use App\Models\Course;

class CollegePageController extends Controller
{
    public function showPublic($college)
    {
        $collegeName = CollegePage::nameFromRouteSlug($college);

        $collegePage = CollegePage::where('college', $collegeName)
            ->with(['courses', 'studentOrganizations'])
            ->firstOrFail();

        return view('pages.academics_public', compact('collegePage'));
    }

    public function showProgram(string $college, Course $course)
    {
        $collegeName = CollegePage::nameFromRouteSlug($college);

        $collegePage = CollegePage::where('college', $collegeName)->firstOrFail();

        if ((int) $course->college_page_id !== (int) $collegePage->id) {
            abort(404);
        }

        $course->load(['department.faculties']);

        return view('pages.academics.program', [
            'collegePage' => $collegePage,
            'collegeSlug' => $collegePage->routeSlug(),
            'course' => $course,
            'faculties' => $course->department?->faculties ?? collect(),
        ]);
    }
}
