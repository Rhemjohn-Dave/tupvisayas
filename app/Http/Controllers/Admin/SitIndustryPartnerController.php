<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitIndustryPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitIndustryPartnerController extends Controller
{
    public function index()
    {
        $partners = SitIndustryPartner::ordered()->get();

        return view('admin.sit_partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.sit_partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $request->file('logo_path')->store('sit_partners', 'public');
        }

        SitIndustryPartner::create($data);

        return redirect()
            ->route('admin.sit-partners.index')
            ->with('success', 'Industry partner created successfully.');
    }

    public function edit(SitIndustryPartner $partner)
    {
        return view('admin.sit_partners.edit', compact('partner'));
    }

    public function update(Request $request, SitIndustryPartner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo_path')) {
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('sit_partners', 'public');
        }

        $partner->update($data);

        return redirect()
            ->route('admin.sit-partners.index')
            ->with('success', 'Industry partner updated successfully.');
    }

    public function destroy(SitIndustryPartner $partner)
    {
        if ($partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
        }

        $partner->delete();

        return redirect()
            ->route('admin.sit-partners.index')
            ->with('success', 'Industry partner deleted successfully.');
    }
}
