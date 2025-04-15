<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CareerResource;
use App\Http\Resources\V1\CareerCollection;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Career::query();

        if ($request->has('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                  ->orWhere('company', 'LIKE', "%{$request->search}%")
                  ->orWhere('location', 'LIKE', "%{$request->search}%");
        }

        $career = $query->latest()->paginate(11);
        return new CareerCollection($career);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'company' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'posted_by' => 'required|exists:alumni_profiles,id',
            'image' => 'nullable|string',
            'date_posted' => 'required|date',
        ]);
    
        $career = Career::create([
            'title' => $validated['title'],
            'company' => $validated['company'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'posted_by' => $validated['posted_by'],
            'image' => $validated['image'] ?? null,
            'date_posted' => $validated['date_posted'],
        ]);
    
        return (new CareerResource($career))
            ->response()
            ->setStatusCode(201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        $career->load(['postedBy', 'careerReplies']);
    
        
        $summary = $career->getJobSummary();
        $formattedDate = $career->getFormattedDatePosted();
        $totalReplies = $career->getTotalReplies();
        $recent = $career->isRecentlyPosted();
    
        return (new CareerResource($career))
            ->response()
            ->setStatusCode(200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'company' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'posted_by' => 'required|exists:alumni_profiles,id',
            'image' => 'nullable|string',
            'date_posted' => 'required|date',
        ]);
    
        $career -> update([
            'title' => $validated['title'],
            'company' => $validated['company'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'posted_by' => $validated['posted_by'],
            'image' => $validated['image'] ?? null,
            'date_posted' => $validated['date_posted'],
        ]);
    
        return (new CareerResource($career))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        return response()->json(null,204);
    }
}
