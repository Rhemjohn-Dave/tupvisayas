<?php

namespace App\Http\Controllers;

use App\Models\AdmissionTestSchedule;
use App\Models\CollegePage;

class AdmissionsController extends Controller
{
    public function undergraduatePrograms()
    {
        // Get all undergraduate programs from COE, COET, and COAC
        // Note: The database stores full college names, not short codes
        $colleges = CollegePage::whereIn('college', [
            'College of Engineering',
            'College of Engineering Technology',
            'College of Automation and Control'
        ])
            ->with('courses')
            ->get();

        // Map full college names to route short codes
        $collegeRouteMap = CollegePage::ROUTE_SLUGS;

        return view('pages.admissions.undergraduate_programs', compact('colleges', 'collegeRouteMap'));
    }

    public function enrollmentProcedure()
    {
        $schedules = AdmissionTestSchedule::query()
            ->published()
            ->ordered()
            ->get();

        return view('pages.admissions.enrollment_procedure', compact('schedules'));
    }
}
