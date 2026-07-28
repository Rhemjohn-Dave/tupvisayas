<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;

class ProcurementController extends Controller
{
    public function bidOpportunities(Request $request)
    {
        $baseQuery = Procurement::query()->where('type', 'bid_opportunity');
        $query = clone $baseQuery;

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('reference_no', 'like', "%{$search}%");
            });
        }
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $sort = $request->input('sort', 'latest');

        match ($sort) {
            'closing_soon' => $query->orderByRaw('closing_date is null')->orderBy('closing_date')->orderByDesc('posting_date'),
            'reference' => $query->orderBy('reference_no'),
            'title' => $query->orderBy('title'),
            default => $query->orderByDesc('posting_date'),
        };

        $procurements = $query->paginate(10)->withQueryString();
        $categories = (clone $baseQuery)->select('category')->distinct()->orderBy('category')->pluck('category');
        $summary = [
            'total' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'awarded' => (clone $baseQuery)->where('status', 'awarded')->count(),
        ];

        return view('procurement.bid-opportunities', compact('procurements', 'categories', 'summary', 'sort'));
    }

    public function philgepsPosting(Request $request)
    {
        $query = Procurement::query()->where('type', 'philgeps_posting');
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('reference_no', 'like', "%{$search}%");
            });
        }
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }
        $procurements = $query->orderByDesc('posting_date')->paginate(10)->withQueryString();
        $categories = Procurement::where('type', 'philgeps_posting')->select('category')->distinct()->pluck('category');
        return view('procurement.philgeps-posting', compact('procurements', 'categories'));
    }
}
