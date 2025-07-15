<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = \App\Models\Event::orderBy('created_at', 'desc')->get();
        return view('pages.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        return view('pages.event_show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $categories = \App\Models\Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('picture')) {
            // Delete old image if exists
            if ($event->picture) {
                \Storage::disk('public')->delete($event->picture);
            }
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->picture) {
            \Storage::disk('public')->delete($event->picture);
        }
        $event->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Event deleted successfully!');
    }
}
