<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitCampusRecruitmentController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->campusRecruitment()
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.sit_campus_recruitments.index', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.sit_campus_recruitments.create', compact('categories'));
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
            'listing_type' => Job::TYPE_CAMPUS_RECRUITMENT,
        ];

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        Job::create($data);

        return redirect()->route('admin.sit_campus_recruitments.index')
            ->with('success', 'Campus recruitment posting created successfully.');
    }

    public function edit(Job $sit_campus_recruitment)
    {
        $this->ensureCampusRecruitment($sit_campus_recruitment);

        $categories = Category::query()->orderBy('name')->get();

        return view('admin.sit_campus_recruitments.edit', [
            'job' => $sit_campus_recruitment,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Job $sit_campus_recruitment)
    {
        $this->ensureCampusRecruitment($sit_campus_recruitment);

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
            'listing_type' => Job::TYPE_CAMPUS_RECRUITMENT,
        ];

        if ($request->hasFile('picture')) {
            if ($sit_campus_recruitment->picture) {
                Storage::disk('public')->delete($sit_campus_recruitment->picture);
            }
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        $sit_campus_recruitment->update($data);

        return redirect()->route('admin.sit_campus_recruitments.index')
            ->with('success', 'Campus recruitment posting updated successfully.');
    }

    public function destroy(Job $sit_campus_recruitment)
    {
        $this->ensureCampusRecruitment($sit_campus_recruitment);

        if ($sit_campus_recruitment->picture) {
            Storage::disk('public')->delete($sit_campus_recruitment->picture);
        }

        $sit_campus_recruitment->delete();

        return redirect()->route('admin.sit_campus_recruitments.index')
            ->with('success', 'Campus recruitment posting deleted successfully.');
    }

    private function ensureCampusRecruitment(Job $job): void
    {
        abort_unless($job->listing_type === Job::TYPE_CAMPUS_RECRUITMENT, 404);
    }
}
