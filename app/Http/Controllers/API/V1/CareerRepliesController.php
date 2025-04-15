<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\CareerReplies;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CareerRepliesResource;
use App\Http\Resources\V1\CareerRepliesCollection;

class CareerRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CareerReplies::query();

        if ($request->has('search')) {
            $keyword = $request->search;
            $query = $query->get()->filter(function ($reply) use ($keyword) {
                return $reply->containsKeyword($keyword);
            });
    
            
            $paginated = $query->values()->paginate(11); 
            return new CareerRepliesCollection($paginated);
        }

        $careerReplies = $query->latest()->paginate(11);
        return new CareerRepliesCollection($careerReplies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'career_id' => 'required|exists:careers,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
            'message' => 'required|string',
        ]);
    
        $careerReplies  = CareerReplies::create([
            'career_id' => $validated['career_id'],
            'alumni_id' => $validated['alumni_id'],
            'message' => $validated['message'],

        ]);

        Log::info('New Career Reply: ' . $careerReplies->getReplySummary());
    
        return (new CareerRepliesResource($careerReplies ))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CareerReplies $careerReplies)
    {
        $careerReplies->load(['career', 'alumni']);
        $summary = $careerReplies->getReplySummary();

        return response()->json([
            'data' => new CareerRepliesResource($careerReplies),
            'meta' => [
                'summary' => $summary,
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CareerReplies $careerReplies)
    {
        $validated = $request->validate([
            'career_id' => 'required|exists:careers,id',
            'alumni_id' => 'required|exists:alumni_profiles,id',
            'message' => 'required|string',
        ]);
    
        $careerReplies -> update([
            'career_id' => $validated['career_id'],
            'alumni_id' => $validated['alumni_id'],
            'message' => $validated['message'],

        ]);
    
        return (new CareerRepliesResource($careerReplies ))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CareerReplies $careerReplies)
    {
        $careerReplies->delete();
        return response()->json(null,204);
    }
}
