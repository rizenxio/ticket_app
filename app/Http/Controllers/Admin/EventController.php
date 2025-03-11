<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        // dd($events);
        return view('Admin.DashboardAdmin', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.AddEvent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'venue' => 'required|string|max:255',
        'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'event_date' => 'required|date',
        'event_time' => 'required',
        'available_seats' => 'required|integer|min:1',
        'description' => 'required|string',
        'total_seats' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:draft,published,cancelled', 
    ]);

    $imageName = time().'.'.$request->images->extension();
    $request->images->move(public_path('assets/images'), $imageName);


    Event::create([
        'title' => $request->title,
        'venue' => $request->venue,
        'event_date' => $request->event_date,
        'event_time' => $request->event_time,
        'description' => $request->description,
        'images' => $imageName,
        'available_seats' => $request->available_seats,
        'total_seats' => $request->total_seats,
        'price' => $request->price,
        'status' => $request->status, 
    ]);

    return redirect()->route('events.index')->with('status', 'Event berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
       //   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        // dd($event);
        return view('Admin.updateEvent',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'available_seats' => 'required|integer|min:1',
            'total_seats' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:draft,published,cancelled', 
        ]);
    
        $event = Event::findOrFail($id);
        $event->update([
            'title' => $request->title,
            'venue' => $request->venue,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'available_seats' => $request->available_seats,
            'total_seats' => $request->total_seats,
            'price' => $request->price,
            'status' => $request->status, 
        ]);
    
        return redirect()->route('events.index')->with('status', 'Event berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $event = Event::find($id);
    
    if (!$event) {
        return redirect()->route('events.index')->with('status', 'Data tidak ditemukan.');
    }

    $event->delete();

    return redirect()->route('events.index')->with('status', 'Data berhasil dihapus.');
}

}
