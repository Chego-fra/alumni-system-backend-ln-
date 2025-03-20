<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

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

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:image,video',
            'url' => 'required|string',
            'description' => 'nullable|string',
            'posted_by' => 'required|string',
        ]);

        $gallery = Gallery::create($data);

        return response()->json($gallery, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'type' => 'sometimes|required|in:image,video',
            'url' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'posted_by' => 'sometimes|required|string',
        ]);

        $gallery->update($data);
        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
