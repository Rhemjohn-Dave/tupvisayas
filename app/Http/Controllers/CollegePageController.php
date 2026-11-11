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
            ->withCount(['courses', 'departments'])
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

        if ($collegePage->isFacultyOnly()) {
            return redirect()->route('academics.faculty', $canonical);
        }

        $collegePage->load([
            'courses',
            'officials',
        ]);
        $dean = $collegePage->dean();
        $collegeSection = 'programs';

        return view('pages.academics_public', compact('collegePage', 'dean', 'collegeSection'));
    }

    public function showFaculty(string $college): View|RedirectResponse
    {
        $collegePage = CollegePage::findByRouteParam($college);
        if (! $collegePage) {
            abort(404);
        }

        $canonical = $collegePage->routeSlug();
        if ($college !== $canonical) {
            return redirect()->route('academics.faculty', $canonical, 301);
        }

        $collegePage->load([
            'officials',
            'departments' => fn ($q) => $q->with(['faculties', 'headFaculty', 'course'])->orderBy('name'),
        ]);
        $dean = $collegePage->dean();
        $collegeSection = 'faculty';

        return view('pages.academics.faculty', compact('collegePage', 'dean', 'collegeSection'));
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

        $course->load(['department.faculties', 'department.headFaculty']);

        return view('pages.academics.program', [
            'collegePage' => $collegePage,
            'collegeSlug' => $canonical,
            'course' => $course,
            'faculties' => $course->department?->faculties ?? collect(),
            'programHead' => $course->programHead(),
        ]);
    }
}
