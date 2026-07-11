<?php

namespace App\Support;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContentFeed
{
    /**
     * Paginated union of news, events, and announcements for the public feed.
     */
    public static function paginateUpdates(?int $categoryId, string $search = '', int $perPage = 12): LengthAwarePaginatorContract
    {
        $news = self::baseSelect(News::query(), 'News', $categoryId, $search);
        $events = self::baseSelect(Event::query(), 'Event', $categoryId, $search);
        $announcements = self::baseSelect(Announcement::query(), 'Announcement', $categoryId, $search);

        $union = $news->unionAll($events)->unionAll($announcements);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $total = DB::query()
            ->fromSub($union, 'content_updates')
            ->count();

        $rows = DB::query()
            ->fromSub($union, 'content_updates')
            ->orderByDesc('created_at')
            ->forPage($page, $perPage)
            ->get()
            ->map(function ($row) {
                $row->created_at = \Carbon\Carbon::parse($row->created_at);

                return $row;
            });

        return new LengthAwarePaginator(
            $rows,
            $total,
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    private static function baseSelect(Builder $query, string $type, ?int $categoryId, string $search): Builder
    {
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search !== '') {
            $query->where(function (Builder $q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        return $query->select([
            'id',
            'title',
            'slug',
            'content',
            'picture',
            'created_at',
        ])->selectRaw('? as type', [$type]);
    }
}
