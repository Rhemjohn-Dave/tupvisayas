<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class AccreditationController extends Controller
{
    /**
     * Show list of programs with links to accreditation pages.
     */
    public function index()
    {
        $courses = Course::with('collegePage')->orderBy('name')->get();

        return view('pages.accreditation.index', compact('courses'));
    }

    /**
     * Show accreditation page for a specific course (with password gate).
     */
    public function show(Course $course, Request $request)
    {
        $hasAccess = $request->session()->get("accreditation_access.{$course->id}", false);

        return view('pages.accreditation.course', compact('course', 'hasAccess'));
    }

    /**
     * Verify accreditation password for a specific course.
     */
    public function verify(Course $course, Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $expectedPassword = config('accreditation.password');

        if (
            ! is_string($expectedPassword)
            || $expectedPassword === ''
            || ! hash_equals($expectedPassword, $request->input('password'))
        ) {
            return back()
                ->withErrors(['password' => 'Incorrect password. Please try again.'])
                ->withInput();
        }

        $request->session()->put("accreditation_access.{$course->id}", true);

        return redirect()
            ->route('accreditation.course.show', $course)
            ->with('status', 'Access granted.');
    }
}
