<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\HrPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HrPostController extends Controller
{
    public function index()
    {
        $posts = HrPost::with(['author', 'department'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.hr_posts.index', compact('posts'));
    }

    public function create()
    {
        $departments = Department::query()->orderBy('name')->get();

        return view('admin.hr_posts.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePost($request);

        $data = $this->payloadFromValidated($request, $validated);
        $data['author_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('hr_posts', 'public');
        }

        if ($request->hasFile('report_file')) {
            $data['report_file'] = $request->file('report_file')->store('hr_posts/reports', 'public');
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        HrPost::create($data);

        return redirect()->route('admin.hr_posts.index')
            ->with('success', 'HR post created successfully.');
    }

    public function edit(HrPost $hrPost)
    {
        $departments = Department::query()->orderBy('name')->get();

        return view('admin.hr_posts.edit', compact('hrPost', 'departments'));
    }

    public function update(Request $request, HrPost $hrPost)
    {
        $validated = $this->validatePost($request, $hrPost);

        $data = $this->payloadFromValidated($request, $validated, $hrPost);

        if ($request->boolean('remove_featured_image')) {
            if ($hrPost->featured_image) {
                Storage::disk('public')->delete($hrPost->featured_image);
            }
            $data['featured_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($hrPost->featured_image) {
                Storage::disk('public')->delete($hrPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('hr_posts', 'public');
        }

        if ($request->boolean('remove_report_file')) {
            if ($hrPost->report_file) {
                Storage::disk('public')->delete($hrPost->report_file);
            }
            $data['report_file'] = null;
        }

        if ($request->hasFile('report_file')) {
            if ($hrPost->report_file) {
                Storage::disk('public')->delete($hrPost->report_file);
            }
            $data['report_file'] = $request->file('report_file')->store('hr_posts/reports', 'public');
        }

        // Clear report when switching to announcement
        if (($data['type'] ?? $hrPost->type) === HrPost::TYPE_ANNOUNCEMENT) {
            if (!empty($hrPost->report_file) && empty($data['report_file'])) {
                Storage::disk('public')->delete($hrPost->report_file);
            }
            $data['report_file'] = null;
        }

        if ($data['is_published'] && !$hrPost->is_published) {
            $data['published_at'] = now();
        }

        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        $hrPost->update($data);

        return redirect()->route('admin.hr_posts.index')
            ->with('success', 'HR post updated successfully.');
    }

    public function destroy(HrPost $hrPost)
    {
        if ($hrPost->featured_image) {
            Storage::disk('public')->delete($hrPost->featured_image);
        }
        if ($hrPost->report_file) {
            Storage::disk('public')->delete($hrPost->report_file);
        }

        $hrPost->delete();

        return redirect()->route('admin.hr_posts.index')
            ->with('success', 'HR post deleted successfully.');
    }

    private function validatePost(Request $request, ?HrPost $existing = null): array
    {
        $slugRule = Rule::unique('hr_posts', 'slug');
        if ($existing) {
            $slugRule = $slugRule->ignore($existing->id);
        }

        $isProgram = in_array($request->input('type'), HrPost::PROGRAM_TYPES, true);

        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'type' => 'required|in:' . implode(',', array_keys(HrPost::typeOptions())),
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'report_file' => 'nullable|file|mimes:pdf|max:10240',
            'department_id' => [
                Rule::requiredIf(fn () => $isProgram),
                'nullable',
                'exists:departments,id',
            ],
            'event_date' => [
                Rule::requiredIf(fn () => $isProgram),
                'nullable',
                'date',
            ],
            'is_published' => 'nullable|boolean',
        ]);
    }

    private function payloadFromValidated(Request $request, array $validated, ?HrPost $existing = null): array
    {
        $type = $validated['type'];
        $isProgram = in_array($type, HrPost::PROGRAM_TYPES, true);

        $data = [
            'title' => $validated['title'],
            'type' => $type,
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? null,
            'department_id' => $isProgram ? ($validated['department_id'] ?? null) : null,
            'event_date' => $isProgram ? ($validated['event_date'] ?? null) : null,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($existing === null) {
            $data['slug'] = $this->resolveSlug($validated['slug'] ?? null, $validated['title']);
        } elseif ($request->filled('slug')) {
            $data['slug'] = $this->resolveSlug($validated['slug'], $validated['title'], $existing->id);
        } elseif (!$existing->slug) {
            $data['slug'] = $this->resolveSlug(null, $validated['title'], $existing->id);
        }

        return $data;
    }

    private function resolveSlug(?string $slug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug ?: $title) ?: 'post';
        $candidate = $base;
        $counter = 1;

        while (
            HrPost::when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $base . '-' . $counter++;
        }

        return $candidate;
    }
}
