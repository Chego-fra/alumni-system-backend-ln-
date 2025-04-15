<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ResourcesResource;
use App\Http\Resources\V1\ResourcesCollection;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Resources::query();

        if ($request->has('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                  ->orWhere('category', 'LIKE', "%{$request->search}%")
                  ->orWhere('posted_by', 'LIKE', "%{$request->search}%");
        }

        $resources = $query->latest()->paginate(11);
        return new ResourcesCollection($resources);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'file_url' => 'nullable|string',
            'video_url' => 'nullable|string',
            'posted_by' => 'required|string',
            'date_posted' => 'required|date',
            'image' => 'nullable|string',
        ]);
    
        $resources = Resources::create([
        'title' => $validated['title'],
        'type' => $validated['type'],
        'file_url' => $validated['file_url'] ?? null,
        'video_url' => $validated['video_url'] ?? null,
        'description' => $validated['description'] ?? null,
        'posted_by' => $validated['posted_by'],
        'date_posted' => $validated['date_posted'],
        'image' => $validated['image'] ?? null,
        ]);
    
        return (new ResourcesResource($resources))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */


    public function show(Resources $resources)
    {
        return (new ResourcesResource($resources))
            ->response()
            ->setStatusCode(200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resources $resources)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'file_url' => 'nullable|string',
            'video_url' => 'nullable|string',
            'posted_by' => 'required|string',
            'date_posted' => 'required|date',
            'image' => 'nullable|string',
        ]);
    
        $resources -> update([
        'title' => $validated['title'],
        'type' => $validated['type'],
        'file_url' => $validated['file_url'] ?? null,
        'video_url' => $validated['video_url'] ?? null,
        'description' => $validated['description'] ?? null,
        'posted_by' => $validated['posted_by'],
        'date_posted' => $validated['date_posted'],
        'image' => $validated['image'] ?? null,
        ]);
    
        return (new ResourcesResource($resources))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resources $resources)
    {
        $resources->delete();
        return response()->json(null,204);
    }
}
