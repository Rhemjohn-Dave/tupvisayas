<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UsgOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsgOfficerController extends Controller
{
    public function index()
    {
        $officers = UsgOfficer::query()
            ->ordered()
            ->paginate(20);

        return view('admin.usg_officers.index', compact('officers'));
    }

    public function create()
    {
        return view('admin.usg_officers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateOfficer($request);

        $data = [
            'name' => $validated['name'],
            'position' => $validated['position'],
            'term_label' => $validated['term_label'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('usg/officers', 'public');
        }

        UsgOfficer::create($data);

        return redirect()->route('admin.usg-officers.index')
            ->with('success', 'USG officer created.');
    }

    public function edit(UsgOfficer $usg_officer)
    {
        return view('admin.usg_officers.edit', [
            'officer' => $usg_officer,
        ]);
    }

    public function update(Request $request, UsgOfficer $usg_officer)
    {
        $validated = $this->validateOfficer($request);

        $data = [
            'name' => $validated['name'],
            'position' => $validated['position'],
            'term_label' => $validated['term_label'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->boolean('remove_photo')) {
            if ($usg_officer->photo) {
                Storage::disk('public')->delete($usg_officer->photo);
            }
            $data['photo'] = null;
        }

        if ($request->hasFile('photo')) {
            if ($usg_officer->photo) {
                Storage::disk('public')->delete($usg_officer->photo);
            }
            $data['photo'] = $request->file('photo')->store('usg/officers', 'public');
        }

        $usg_officer->update($data);

        return redirect()->route('admin.usg-officers.index')
            ->with('success', 'USG officer updated.');
    }

    public function destroy(UsgOfficer $usg_officer)
    {
        if ($usg_officer->photo) {
            Storage::disk('public')->delete($usg_officer->photo);
        }

        $usg_officer->delete();

        return redirect()->route('admin.usg-officers.index')
            ->with('success', 'USG officer deleted.');
    }

    private function validateOfficer(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'term_label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'remove_photo' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);
    }
}
