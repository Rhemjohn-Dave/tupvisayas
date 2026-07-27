<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionTestSchedule;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdmissionTestScheduleController extends Controller
{
    public function index()
    {
        $schedules = AdmissionTestSchedule::query()->ordered()->paginate(20);
        $tupstatHeroEnabled = SiteSetting::tupstatHeroEnabled();
        $publishedCount = AdmissionTestSchedule::query()->published()->count();

        return view('admin.admission_schedules.index', compact(
            'schedules',
            'tupstatHeroEnabled',
            'publishedCount'
        ));
    }

    public function updatePromo(Request $request)
    {
        $request->validate([
            'tupstat_hero_enabled' => ['sometimes', 'boolean'],
        ]);

        SiteSetting::setBoolean(
            SiteSetting::TUPSTAT_HERO_ENABLED,
            $request->boolean('tupstat_hero_enabled')
        );

        return redirect()
            ->route('admin.admission-schedules.index')
            ->with('status', 'Homepage TUPSTAT promo setting saved.');
    }

    public function create()
    {
        return view('admin.admission_schedules.form', [
            'schedule' => new AdmissionTestSchedule([
                'is_published' => true,
                'sort_order' => (int) AdmissionTestSchedule::max('sort_order') + 1,
                'times' => "8 AM\n1 PM",
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        AdmissionTestSchedule::create($data);

        return redirect()
            ->route('admin.admission-schedules.index')
            ->with('status', 'Admission test schedule created.');
    }

    public function edit(AdmissionTestSchedule $admission_schedule)
    {
        return view('admin.admission_schedules.form', [
            'schedule' => $admission_schedule,
        ]);
    }

    public function update(Request $request, AdmissionTestSchedule $admission_schedule)
    {
        $admission_schedule->update($this->validated($request));

        return redirect()
            ->route('admin.admission-schedules.index')
            ->with('status', 'Admission test schedule updated.');
    }

    public function destroy(AdmissionTestSchedule $admission_schedule)
    {
        $admission_schedule->delete();

        return redirect()
            ->route('admin.admission-schedules.index')
            ->with('status', 'Admission test schedule deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'exam_date' => ['required', 'date'],
            'times' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'venue_note' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['venue_note'] = $data['venue_note'] ?? null;

        return $data;
    }
}
