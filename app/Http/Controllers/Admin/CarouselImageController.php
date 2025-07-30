<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarouselImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carouselImages = \App\Models\CarouselImage::orderBy('order')->get();
        return view('admin.carousel_images.index', compact('carouselImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carousel_images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'caption' => 'nullable|string|max:255', // Temporarily commented out
            'order' => 'required|integer',
        ]);

        $data = $request->only(['order']); // Removed 'caption' temporarily
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('carousel', 'public');
        }

        \App\Models\CarouselImage::create($data);

        return redirect()->route('admin.carousel-images.index')->with('success', 'Carousel image created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $carouselImage = \App\Models\CarouselImage::findOrFail($id);
        return view('admin.carousel_images.edit', compact('carouselImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $carouselImage = \App\Models\CarouselImage::findOrFail($id);
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ]);
        $data = $request->only(['caption', 'order']);
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($carouselImage->image_path) {
                \Storage::disk('public')->delete($carouselImage->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('carousel', 'public');
        }
        $carouselImage->update($data);
        return redirect()->route('admin.carousel-images.index')->with('success', 'Carousel image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carouselImage = \App\Models\CarouselImage::findOrFail($id);
        if ($carouselImage->image_path) {
            \Storage::disk('public')->delete($carouselImage->image_path);
        }
        $carouselImage->delete();
        return redirect()->route('admin.carousel-images.index')->with('success', 'Carousel image deleted successfully.');
    }
}
