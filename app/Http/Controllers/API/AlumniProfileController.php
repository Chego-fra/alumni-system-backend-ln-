<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;

class AlumniProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AlumniProfile::query();

        // Search functionality
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%")
                  ->orWhere('major', 'LIKE', "%{$request->search}%")
                  ->orWhere('company', 'LIKE', "%{$request->search}%");
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|string',
            'graduation_year' => 'required|integer',
            'major' => 'required|string',
            'company' => 'nullable|string',
            'location' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        $alumni = AlumniProfile::create($data);
        return response()->json($alumni, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AlumniProfile $alumni)
    {
        return response()->json($alumni);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlumniProfile $alumni)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'image' => 'nullable|string',
            'graduation_year' => 'sometimes|required|integer',
            'major' => 'sometimes|required|string',
            'company' => 'nullable|string',
            'location' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        $alumni->update($data);
        return response()->json($alumni);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlumniProfile $alumni)
    {
        $alumni->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
