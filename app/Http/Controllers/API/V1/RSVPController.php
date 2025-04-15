<?php

namespace App\Http\Controllers\API\V1;

use App\Models\RSVP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RSVPResource;
use App\Http\Resources\V1\RSVPCollection;

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

        $rSVP = $query->latest()->paginate(11);
        return new RSVPCollection($rSVP);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
        ]);
    
        $rSVP  = RSVP::create([
            'event_id' => $validated['event_id'],
            'alumni_id' => $validated['alumni_id'],
        ]);
    
        return (new RSVPResource($rSVP ))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RSVP $rSVP)
    {
        return (new RSVPResource($rSVP))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RSVP $rSVP)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
        ]);
    
        $rSVP  -> update([
            'event_id' => $validated['event_id'],
            'alumni_id' => $validated['alumni_id'],
        ]);
    
        return (new RSVPResource($rSVP ))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RSVP $rSVP)
    {
        $rSVP ->delete();
        return response()->json(null,204);
    }
}
