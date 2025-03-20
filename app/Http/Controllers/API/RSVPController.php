<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RSVP;
use Illuminate\Http\Request;

class RSVPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RSVP::query();

        if ($request->has('search')) {
            $query->where('event_id', 'LIKE', "%{$request->search}%");
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
        ]);

        $rsvp = RSVP::create($data);

        return response()->json($rsvp, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RSVP $rsvp)
    {
        return response()->json($rsvp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
        ]);
    
        $rsvp = RSVP::findOrFail($id);
        $rsvp->update($data);
    
        return response()->json($rsvp);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RSVP $rsvp)
    {
        $rsvp->delete();
        return response()->json(['message' => 'RSVP removed successfully']);
    }
}
