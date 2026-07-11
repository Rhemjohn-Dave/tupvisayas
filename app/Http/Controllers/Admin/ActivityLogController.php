<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query()->with(['causer', 'subject'])->latest();

        if ($request->filled('log')) {
            $query->where('log_name', $request->string('log'));
        }

        if ($request->filled('event')) {
            $query->where('event', $request->string('event'));
        }

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('description', 'like', '%' . $q . '%')
                    ->orWhere('log_name', 'like', '%' . $q . '%')
                    ->orWhere('event', 'like', '%' . $q . '%');
            });
        }

        $activities = $query->paginate(25)->withQueryString();

        $logNames = Activity::query()
            ->select('log_name')
            ->distinct()
            ->orderBy('log_name')
            ->pluck('log_name')
            ->filter()
            ->values();

        return view('admin.activity_logs.index', compact('activities', 'logNames'));
    }
}
