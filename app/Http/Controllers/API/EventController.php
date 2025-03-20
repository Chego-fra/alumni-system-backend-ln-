<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->has('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                  ->orWhere('location', 'LIKE', "%{$request->search}%");
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'organizer' => 'required|string',
            'attendees' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);

        $event = Event::create($data);
        $alumniEmails = AlumniProfile::pluck('email'); // Fetch all alumni emails

        foreach ($alumniEmails as $email) {
            Mail::raw("A new event '{$event->title}' is scheduled on {$event->date}.", function ($message) use ($email) {
                $message->to($email)->subject('New Event Alert');
            });
        }

        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'organizer' => 'sometimes|required|string',
            'attendees' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);

        $event->update($data);
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
