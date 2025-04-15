<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GalleryResource;
use App\Http\Resources\V1\GalleryCollection;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();
        if ($request->has('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                  ->orWhere('type', 'LIKE', "%{$request->search}%")
                  ->orWhere('posted_by', 'LIKE', "%{$request->search}%");
        }

        $gallery = $query->latest()->paginate(11);
        return new GalleryCollection($gallery);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:image,video',
            'file_path' => 'required|string',
            'description' => 'nullable|string',
            'posted_by' => 'required|string',
        ]);
    
        $gallery = Gallery::create([
        'title' => $validated['title'],
        'type' => $validated['type'],
        'file_path' => $validated['file_path'],
        'description' => $validated['description'] ?? null,
        'posted_by' => $validated['posted_by'],
        ]);
    
        return (new GalleryResource($gallery))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['postedBy']);
        $icon = $gallery->getTypeIcon(); 
        return (new GalleryResource($gallery))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
                $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:image,video',
            'file_path' => 'required|string',
            'description' => 'nullable|string',
            'posted_by' => 'required|string',
        ]);
    
        $gallery -> update([
        'title' => $validated['title'],
        'type' => $validated['type'],
        'file_path' => $validated['file_path'],
        'description' => $validated['description'] ?? null,
        'posted_by' => $validated['posted_by'],
        ]);
    
        return (new GalleryResource($gallery))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json(null,204);
    }
}
