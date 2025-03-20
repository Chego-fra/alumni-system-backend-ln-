<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Resource::query();

        if ($request->has('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                  ->orWhere('category', 'LIKE', "%{$request->search}%")
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
            'category' => 'required|string',
            'description' => 'nullable|string',
            'file_url' => 'nullable|string',
            'video_url' => 'nullable|string',
            'posted_by' => 'required|string',
            'date_posted' => 'required|date',
            'image' => 'nullable|string',
        ]);

        $resource = Resource::create($data);

        return response()->json($resource, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return response()->json($resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'file_url' => 'nullable|string',
            'video_url' => 'nullable|string',
            'posted_by' => 'sometimes|required|string',
            'date_posted' => 'sometimes|required|date',
            'image' => 'nullable|string',
        ]);

        $resource->update($data);
        return response()->json($resource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
