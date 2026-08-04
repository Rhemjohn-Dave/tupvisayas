<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitGalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitGalleryImageController extends Controller
{
    public function index()
    {
        $images = SitGalleryImage::ordered()->get();

        return view('admin.sit_gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.sit_gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'caption' => 'nullable|string|max:255',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['image_path'] = $request->file('image_path')->store('sit_gallery', 'public');

        SitGalleryImage::create($data);

        return redirect()
            ->route('admin.sit-gallery.index')
            ->with('success', 'Student experience photo added successfully.');
    }

    public function edit(SitGalleryImage $image)
    {
        return view('admin.sit_gallery.edit', compact('image'));
    }

    public function update(Request $request, SitGalleryImage $image)
    {
        $data = $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'caption' => 'nullable|string|max:255',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_path')) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('sit_gallery', 'public');
        }

        $image->update($data);

        return redirect()
            ->route('admin.sit-gallery.index')
            ->with('success', 'Student experience photo updated successfully.');
    }

    public function destroy(SitGalleryImage $image)
    {
        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()
            ->route('admin.sit-gallery.index')
            ->with('success', 'Student experience photo deleted successfully.');
    }
}
