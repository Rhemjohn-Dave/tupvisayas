<?php

namespace App\Http\Controllers;

use App\Models\CollegePage;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CollegePageController extends Controller
{
    public function index()
    {
        $colleges = CollegePage::query()
            ->withCount('courses')
            ->orderBy('college')
            ->get();

        return view('pages.academics.index', compact('colleges'));
    }

    public function showPublic(string $college): View|RedirectResponse
    {
        $collegePage = CollegePage::findByRouteParam($college);
        if (! $collegePage) {
            abort(404);
        }

        $canonical = $collegePage->routeSlug();
        if ($college !== $canonical) {
            return redirect()->route('academics.show', $canonical, 301);
        }

        $collegePage->load(['courses', 'studentOrganizations']);

        return view('pages.academics_public', compact('collegePage'));
    }

    public function showProgram(string $college, Course $course): View|RedirectResponse
    {
        $collegePage = CollegePage::findByRouteParam($college);
        if (! $collegePage) {
            abort(404);
        }

        if ((int) $course->college_page_id !== (int) $collegePage->id) {
            abort(404);
        }

        $canonical = $collegePage->routeSlug();
        if ($college !== $canonical) {
            return redirect()->route('academics.program', [$canonical, $course->slug], 301);
        }

        $course->load(['department.faculties']);

        return view('pages.academics.program', [
            'collegePage' => $collegePage,
            'collegeSlug' => $canonical,
            'course' => $course,
            'faculties' => $course->department?->faculties ?? collect(),
        ]);
    }
}
