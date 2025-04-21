<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\AlumniProfile;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AlumniProfileResource;
use App\Http\Resources\V1\AlumniProfileCollection;

class AlumniProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AlumniProfile::query();
        Log::info("Fetching alumni profiles with query: " . $query->toSql());
    
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            Log::info("Search term: {$searchTerm}");
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('major', 'LIKE', "%{$searchTerm}%");
        }
    
        $alumniProfile = $query->latest()->paginate(11);
        
        return new AlumniProfileCollection($alumniProfile);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|string',
            'graduation_year' => 'required|integer',
            'major' => 'required|string',
            'company' => 'nullable|string',
            'location' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);
    
        $alumniProfile = AlumniProfile::create([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'graduation_year' => $validated['graduation_year'],
            'major' => $validated['major'],
            'company' => $validated['company'] ?? null,
            'location' => $validated['location'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'twitter' => $validated['twitter'] ?? null,
        ]);
    
        return (new AlumniProfileResource($alumniProfile))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AlumniProfile $alumniProfile)
    {
        $alumniProfile->load(['careers', 'careerReplies', 'rsvps']);    
        return (new AlumniProfileResource($alumniProfile))
        ->response()
        ->setStatusCode(200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlumniProfile $alumniProfile)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|string',
            'graduation_year' => 'required|integer',
            'major' => 'required|string',
            'company' => 'nullable|string',
            'location' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);
    
         $alumniProfile->update([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'graduation_year' => $validated['graduation_year'],
            'major' => $validated['major'],
            'company' => $validated['company'] ?? null,
            'location' => $validated['location'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'twitter' => $validated['twitter'] ?? null,
        ]);
    
        return (new AlumniProfileResource($alumniProfile))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlumniProfile $alumniProfile)
    {
        $alumniProfile->delete();
        return response()->json(null,204);
    }
}
