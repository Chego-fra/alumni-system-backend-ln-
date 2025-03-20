<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\JobPosted;
use App\Models\AlumniProfile;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'company' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'posted_by' => 'required|exists:alumni_profiles,id',
            'image' => 'nullable|string',
            'date_posted' => 'required|date',
        ]);

        $career = Career::create($data);

        // Send email logic here

        $alumniEmails = AlumniProfile::pluck('email'); // Fetch all alumni emails

        foreach ($alumniEmails as $email) {
            Mail::to($email)->send(new JobPosted($career));
        }

        return response()->json($career, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        return response()->json($career);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'company' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'requirements' => 'sometimes|required|string',
            'posted_by' => 'sometimes|required|exists:alumni_profiles,id',
            'image' => 'nullable|string',
            'date_posted' => 'sometimes|required|date',
        ]);

        $career->update($data);
        return response()->json($career);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
