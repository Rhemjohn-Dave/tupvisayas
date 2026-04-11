<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Event;
use App\Models\Job;
use App\Models\News;
use App\Models\Official;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $rows = $this->collectDashboardRows();

        $type = $request->query('type');
        if ($type && in_array($type, ['news', 'announcement', 'job', 'event'], true)) {
            $rows = $rows->where('type', $type);
        }

        $q = $request->query('q');
        if (is_string($q) && $q !== '') {
            $qLower = mb_strtolower($q);
            $rows = $rows->filter(function (array $r) use ($qLower) {
                return str_contains(mb_strtolower($r['title']), $qLower)
                    || str_contains(mb_strtolower($r['category']), $qLower);
            });
        }

        $rows = $rows->values();

        $sort = $request->query('sort', 'created_at');
        if (! in_array($sort, ['title', 'type', 'category', 'created_at'], true)) {
            $sort = 'created_at';
        }
        $dir = $request->query('dir', 'desc') === 'asc' ? 'asc' : 'desc';

        if ($sort === 'created_at') {
            $sorted = $dir === 'desc'
                ? $rows->sortByDesc(fn (array $r) => $r['created_at']->timestamp)
                : $rows->sortBy(fn (array $r) => $r['created_at']->timestamp);
        } else {
            $sorted = $rows->sortBy(fn (array $r) => mb_strtolower((string) $r[$sort]));
            if ($dir === 'desc') {
                $sorted = $sorted->reverse();
            }
        }
        $sorted = $sorted->values();

        $perPage = 15;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $slice = $sorted->slice(($page - 1) * $perPage, $perPage)->values();

        $dashboardPaginator = new LengthAwarePaginator(
            $slice,
            $sorted->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        $stats = [
            'posts' => News::count() + Announcement::count() + Job::count() + Event::count(),
            'users' => User::count(),
            'categories' => Category::count(),
            'officials' => Official::count(),
        ];

        $filters = [
            'type' => $type,
            'q' => $q,
            'sort' => $sort,
            'dir' => $dir,
        ];

        return view('admin.dashboard', compact('dashboardPaginator', 'stats', 'filters'));
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function collectDashboardRows(): Collection
    {
        $rows = collect();

        foreach (News::with('category')->get() as $item) {
            $rows->push([
                'title' => $item->title,
                'type' => 'news',
                'type_label' => 'News',
                'category' => $item->category?->name ?? '—',
                'created_at' => $item->created_at,
                'view_url' => route('news.show', $item->slug),
                'edit_url' => route('admin.news.edit', $item->slug),
                'destroy_url' => route('admin.news.destroy', $item->slug),
            ]);
        }

        foreach (Announcement::with('category')->get() as $item) {
            $rows->push([
                'title' => $item->title,
                'type' => 'announcement',
                'type_label' => 'Announcement',
                'category' => $item->category?->name ?? '—',
                'created_at' => $item->created_at,
                'view_url' => route('announcements.show', $item->slug),
                'edit_url' => route('admin.announcements.edit', $item->slug),
                'destroy_url' => route('admin.announcements.destroy', $item->slug),
            ]);
        }

        foreach (Job::with('category')->get() as $item) {
            $rows->push([
                'title' => $item->title,
                'type' => 'job',
                'type_label' => 'Job',
                'category' => $item->category?->name ?? '—',
                'created_at' => $item->created_at,
                'view_url' => route('jobs.show', $item->slug),
                'edit_url' => route('admin.jobs.edit', $item->slug),
                'destroy_url' => route('admin.jobs.destroy', $item->slug),
            ]);
        }

        foreach (Event::with('category')->get() as $item) {
            $rows->push([
                'title' => $item->title,
                'type' => 'event',
                'type_label' => 'Event',
                'category' => $item->category?->name ?? '—',
                'created_at' => $item->created_at,
                'view_url' => route('events.show', $item->slug),
                'edit_url' => route('admin.events.edit', $item->slug),
                'destroy_url' => route('admin.events.destroy', $item->slug),
            ]);
        }

        return $rows;
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:news,announcement,job,event',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        switch ($request->type) {
            case 'news':
                News::create($data);
                break;
            case 'announcement':
                Announcement::create($data);
                break;
            case 'job':
                Job::create($data);
                break;
            case 'event':
                Event::create($data);
                break;
        }

        return redirect()->route('admin.dashboard')->with('success', 'Post created successfully!');
    }

    public function indexCategory()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        $slug = \Str::slug($request->name);
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }
}
