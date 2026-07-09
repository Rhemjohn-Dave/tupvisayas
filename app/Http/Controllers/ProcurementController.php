<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;

class ProcurementController extends Controller
{
    public function bidOpportunities(Request $request)
    {
        $query = Procurement::query()->where('type', 'bid_opportunity');
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
        $categories = Procurement::where('type', 'bid_opportunity')->select('category')->distinct()->pluck('category');
        return view('procurement.bid-opportunities', compact('procurements', 'categories'));
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
