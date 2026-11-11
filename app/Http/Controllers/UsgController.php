<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\UsgDocument;
use App\Models\UsgOfficer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsgController extends Controller
{
    public function index(): View
    {
        $officers = UsgOfficer::query()
            ->published()
            ->ordered()
            ->get();

        $recentDocuments = UsgDocument::query()
            ->published()
            ->orderByDesc('issued_at')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('pages.usg.index', [
            'about' => SiteSetting::getValue(SiteSetting::USG_ABOUT, ''),
            'mission' => SiteSetting::getValue(SiteSetting::USG_MISSION, ''),
            'vision' => SiteSetting::getValue(SiteSetting::USG_VISION, ''),
            'contactEmail' => SiteSetting::getValue(SiteSetting::USG_CONTACT_EMAIL, ''),
            'officeHours' => SiteSetting::getValue(SiteSetting::USG_OFFICE_HOURS, ''),
            'officers' => $officers,
            'recentDocuments' => $recentDocuments,
            'categories' => UsgDocument::categoryOptions(),
        ]);
    }

    public function documents(Request $request): View
    {
        $categories = UsgDocument::categoryOptions();
        $category = $request->query('category');
        if ($category && ! array_key_exists($category, $categories)) {
            $category = null;
        }

        $query = UsgDocument::query()
            ->published()
            ->orderByDesc('issued_at')
            ->orderByDesc('created_at');

        if ($category) {
            $query->where('category', $category);
        }

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('reference_no', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%");
            });
        }

        $documents = $query->paginate(12)->withQueryString();

        return view('pages.usg.documents', [
            'documents' => $documents,
            'categories' => $categories,
            'activeCategory' => $category,
            'search' => $request->q,
        ]);
    }
}
