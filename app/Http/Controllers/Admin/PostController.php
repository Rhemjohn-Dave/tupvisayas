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
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        if ($type && ! in_array($type, ['news', 'announcement', 'job', 'job_opening', 'campus_recruitment', 'event'], true)) {
            $type = null;
        }

        $q = is_string($request->query('q')) ? trim($request->query('q')) : '';
        $sort = $request->query('sort', 'created_at');
        if (! in_array($sort, ['title', 'type', 'category', 'created_at'], true)) {
            $sort = 'created_at';
        }
        $dir = $request->query('dir', 'desc') === 'asc' ? 'asc' : 'desc';

        $dashboardPaginator = $this->paginateDashboard($request, $type, $q, $sort, $dir);

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

    private function paginateDashboard(Request $request, ?string $type, string $q, string $sort, string $dir): LengthAwarePaginator
    {
        $perPage = 15;
        $page = LengthAwarePaginator::resolveCurrentPage();

        if ($type) {
            return $this->paginateSingleType($request, $type, $q, $sort, $dir, $perPage, $page);
        }

        $news = $this->dashboardSelect(News::query(), 'news', 'News', 'news.show', 'admin.news.edit', 'admin.news.destroy', $q);
        $announcements = $this->dashboardSelect(Announcement::query(), 'announcement', 'Announcement', 'announcements.show', 'admin.announcements.edit', 'admin.announcements.destroy', $q);
        $jobs = $this->dashboardSelect(
            Job::query(),
            'job',
            'Job',
            'jobs.show',
            'admin.jobs.edit',
            'admin.jobs.destroy',
            $q,
            "CASE WHEN jobs.listing_type = '" . Job::TYPE_CAMPUS_RECRUITMENT . "' THEN 'Campus recruitment' ELSE 'Job opening' END"
        );
        $events = $this->dashboardSelect(Event::query(), 'event', 'Event', 'events.show', 'admin.events.edit', 'admin.events.destroy', $q);

        $union = $news->unionAll($announcements)->unionAll($jobs)->unionAll($events);

        $orderColumn = match ($sort) {
            'title' => 'title',
            'type' => 'type_label',
            'category' => 'category',
            default => 'created_at',
        };

        $total = DB::query()->fromSub($union, 'dashboard_posts')->count();

        $rows = DB::query()
            ->fromSub($union, 'dashboard_posts')
            ->orderBy($orderColumn, $dir)
            ->forPage($page, $perPage)
            ->get()
            ->map(fn ($row) => $this->mapDashboardRow($row));

        return new LengthAwarePaginator($rows, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    }

    private function paginateSingleType(
        Request $request,
        string $type,
        string $q,
        string $sort,
        string $dir,
        int $perPage,
        int $page
    ): LengthAwarePaginator {
        [$model, $typeKey, $typeLabel, $showRoute, $editRoute, $destroyRoute] = match ($type) {
            'news' => [News::class, 'news', 'News', 'news.show', 'admin.news.edit', 'admin.news.destroy'],
            'announcement' => [Announcement::class, 'announcement', 'Announcement', 'announcements.show', 'admin.announcements.edit', 'admin.announcements.destroy'],
            'job', 'job_opening', 'campus_recruitment' => [Job::class, 'job', 'Job', 'jobs.show', 'admin.jobs.edit', 'admin.jobs.destroy'],
            default => [Event::class, 'event', 'Event', 'events.show', 'admin.events.edit', 'admin.events.destroy'],
        };

        $query = $model::query()->with('category');

        if ($type === 'job_opening') {
            $query->where('listing_type', Job::TYPE_JOB_OPENING);
            $typeLabel = 'Job opening';
        } elseif ($type === 'campus_recruitment') {
            $query->where('listing_type', Job::TYPE_CAMPUS_RECRUITMENT);
            $typeLabel = 'Campus recruitment';
        } elseif ($type === 'job') {
            $typeLabel = 'Job';
        }

        if ($q !== '') {
            $query->where(function (Builder $builder) use ($q) {
                $builder->where('title', 'like', '%' . $q . '%')
                    ->orWhereHas('category', fn (Builder $c) => $c->where('name', 'like', '%' . $q . '%'));
            });
        }

        if ($sort === 'category') {
            $query->leftJoin('categories', 'categories.id', '=', $query->getModel()->getTable() . '.category_id')
                ->select($query->getModel()->getTable() . '.*')
                ->orderBy('categories.name', $dir);
        } elseif ($sort === 'title') {
            $query->orderBy('title', $dir);
        } elseif ($sort === 'type') {
            $query->orderBy('created_at', $dir);
        } else {
            $query->orderBy('created_at', $dir);
        }

        $paginator = $query->paginate($perPage, ['*'], 'page', $page)->withQueryString();

        $mapped = $paginator->getCollection()->map(function ($item) use ($typeKey, $typeLabel, $showRoute, $editRoute, $destroyRoute) {
            return [
                'title' => $item->title,
                'type' => $typeKey,
                'type_label' => $item instanceof Job ? $item->listingTypeLabel() : $typeLabel,
                'category' => $item->category?->name ?? '—',
                'created_at' => $item->created_at,
                'view_url' => route($showRoute, $item->slug),
                'edit_url' => route($editRoute, $item->slug),
                'destroy_url' => route($destroyRoute, $item->slug),
            ];
        });

        $paginator->setCollection($mapped);

        return $paginator;
    }

    private function dashboardSelect(
        Builder $query,
        string $type,
        string $typeLabel,
        string $showRoute,
        string $editRoute,
        string $destroyRoute,
        string $q,
        ?string $typeLabelSql = null
    ): Builder {
        $table = $query->getModel()->getTable();

        if ($q !== '') {
            $query->where(function (Builder $builder) use ($q, $table) {
                $builder->where("{$table}.title", 'like', '%' . $q . '%')
                    ->orWhereExists(function ($sub) use ($q, $table) {
                        $sub->select(DB::raw(1))
                            ->from('categories')
                            ->whereColumn('categories.id', "{$table}.category_id")
                            ->where('categories.name', 'like', '%' . $q . '%');
                    });
            });
        }

        $query = $query
            ->leftJoin('categories', 'categories.id', '=', "{$table}.category_id")
            ->select([
                "{$table}.title",
                "{$table}.slug",
                "{$table}.created_at",
            ])
            ->selectRaw('? as type', [$type]);

        if ($typeLabelSql) {
            $query->selectRaw($typeLabelSql . ' as type_label');
        } else {
            $query->selectRaw('? as type_label', [$typeLabel]);
        }

        return $query
            ->selectRaw('COALESCE(categories.name, ?) as category', ['—'])
            ->selectRaw('? as show_route', [$showRoute])
            ->selectRaw('? as edit_route', [$editRoute])
            ->selectRaw('? as destroy_route', [$destroyRoute]);
    }

    private function mapDashboardRow(object $row): array
    {
        return [
            'title' => $row->title,
            'type' => $row->type,
            'type_label' => $row->type_label,
            'category' => $row->category ?: '—',
            'created_at' => Carbon::parse($row->created_at),
            'view_url' => route($row->show_route, $row->slug),
            'edit_url' => route($row->edit_route, $row->slug),
            'destroy_url' => route($row->destroy_route, $row->slug),
        ];
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
            'listing_type' => 'required_if:type,job|nullable|in:' . implode(',', array_keys(Job::listingTypes())),
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
                $data['listing_type'] = $request->input('listing_type', Job::TYPE_JOB_OPENING);
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
