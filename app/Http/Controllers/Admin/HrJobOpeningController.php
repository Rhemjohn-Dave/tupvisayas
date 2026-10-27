<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HrJobOpeningController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->jobOpenings()
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.hr_job_openings.index', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.hr_job_openings.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'listing_type' => Job::TYPE_JOB_OPENING,
        ];

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        Job::create($data);

        return redirect()->route('admin.hr_job_openings.index')
            ->with('success', 'Job opening created successfully.');
    }

    public function edit(Job $hr_job_opening)
    {
        $this->ensureJobOpening($hr_job_opening);

        $categories = Category::query()->orderBy('name')->get();

        return view('admin.hr_job_openings.edit', [
            'job' => $hr_job_opening,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Job $hr_job_opening)
    {
        $this->ensureJobOpening($hr_job_opening);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'listing_type' => Job::TYPE_JOB_OPENING,
        ];

        if ($request->hasFile('picture')) {
            if ($hr_job_opening->picture) {
                Storage::disk('public')->delete($hr_job_opening->picture);
            }
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        $hr_job_opening->update($data);

        return redirect()->route('admin.hr_job_openings.index')
            ->with('success', 'Job opening updated successfully.');
    }

    public function destroy(Job $hr_job_opening)
    {
        $this->ensureJobOpening($hr_job_opening);

        if ($hr_job_opening->picture) {
            Storage::disk('public')->delete($hr_job_opening->picture);
        }

        $hr_job_opening->delete();

        return redirect()->route('admin.hr_job_openings.index')
            ->with('success', 'Job opening deleted successfully.');
    }

    private function ensureJobOpening(Job $job): void
    {
        abort_unless($job->listing_type === Job::TYPE_JOB_OPENING, 404);
    }
}
