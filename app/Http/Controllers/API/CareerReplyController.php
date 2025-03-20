<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CareerReply;
use Illuminate\Http\Request;

class CareerReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CareerReply::query();

        if ($request->has('search')) {
            $query->where('message', 'LIKE', "%{$request->search}%");
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'career_id' => 'required|exists:careers,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
            'message' => 'required|string',
        ]);

        $reply = CareerReply::create($data);

        return response()->json($reply, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CareerReply $reply)
    {
        return response()->json($reply);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);
    
        $reply = CareerReply::findOrFail($id);
        $reply->update($data);
    
        return response()->json($reply);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CareerReply $reply)
    {
        $reply->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
