<?php

namespace App\Http\Controllers;

use App\Models\AdmissionTestSchedule;
use App\Models\CollegePage;

class AdmissionsController extends Controller
{
    public function undergraduatePrograms()
    {
        $colleges = CollegePage::query()
            ->where(function ($query) {
                $query->whereIn('college', [
                    'College of Engineering',
                    'College of Engineering Technology',
                    'College of Automation and Control',
                    'College of Automation and Control Engineering',
                ])->orWhere('college', 'like', 'College of Automation and Control%');
            })
            ->with('courses')
            ->orderBy('college')
            ->get();

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
