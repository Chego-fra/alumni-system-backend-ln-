<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

            
        $user = $query->latest()->paginate(11);
        
        return new UserCollection( $user);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);
    
        $validated['password'] = Hash::make($validated['password']);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'role' => $validated['role'],
   
        ]);

        return (new UserResource($user))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return (new UserResource($user))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
  

     public function update(Request $request, User $user)
     {
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . $user->id,
             'password' => 'nullable|string|min:8',
             'role' => 'required|string',
         ]);
     
         if (isset($validated['password'])) {
             $validated['password'] = Hash::make($validated['password']);
         } else {
             unset($validated['password']);
         }
     
         $user->update([
             'name' => $validated['name'],
             'email' => $validated['email'] ?? null,
             'password' => $validated['password'] ?? $user->password,
             'role' => $validated['role'],
         ]);
     
         return (new UserResource($user))
             ->response()
             ->setStatusCode(200);
     }
     
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null,204);
    }
}
