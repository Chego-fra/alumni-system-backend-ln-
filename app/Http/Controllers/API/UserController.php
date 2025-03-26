<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get the authenticated user's details.
     */
    public function profile()
    {
        $user = Auth::user();
    
        $message = 'Welcome!';
        
        if ($user->isAdmin()) {
            $message = 'You are an admin!';
        } elseif ($user->isFaculty()) {
            $message = 'You are faculty!';
        } elseif ($user->isAlumni()) {
            $message = 'You are an alumni!';
        }
    
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role, // Ensure role is explicitly included
            ],
            'message' => $message
        ]);
    }
    
    

    /**
     * Update user profile (name and email).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Password updated successfully']);
    }

    /**
     * Get all users (Admin only).
     */
    public function getAllUsers()
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        $users = User::orderBy('created_at', 'desc')->paginate(10, ['id', 'name', 'email', 'role', 'created_at']);
    
        return response()->json($users);
    }
    

    /**
     * Change user role (Admin only).
     */
    public function changeUserRole(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'role' => 'required|string|in:admin,alumni,faculty,guest',
        ]);

        $user = User::findOrFail($id);
        $user->update(['role' => $request->role]);

        return response()->json([
            'message' => 'User role updated successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ]);
        
    }

    /**
     * Delete a user (Admin only).
     */
    public function deleteUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
