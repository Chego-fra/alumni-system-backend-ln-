<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventsResource;
use App\Http\Resources\V1\EventsCollection;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Events::query();
    
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('body', 'LIKE', "%{$searchTerm}%");
        }
    
        
        $events = $query->latest()->paginate(11);
    
        
        return new EventsCollection($events);  
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'organizer' => 'required|string',
            'attendees' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);
    
        $event = Events::create([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'organizer' => $validated['organizer'],
            'attendees' => $validated['attendees'] ?? null,
            'image' => $validated['image'] ?? null,
        ]);
    
        return (new EventsResource($event))
            ->response()
            ->setStatusCode(201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Events $events)
    {
        $events->load(['rsvps']);
        return (new EventsResource($events))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'organizer' => 'required|string',
            'attendees' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);
    
        $events->update([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'organizer' => $validated['organizer'],
            'attendees' => $validated['attendees'] ?? null,
            'image' => $validated['image'] ?? null,
        ]);
    
        return (new EventsResource($events))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $events)
    {
        $events->delete();
        return response()->json(null,204);
    }
}
