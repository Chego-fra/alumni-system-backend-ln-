<?php

use App\Http\Controllers\API\AlumniProfileController;
use App\Http\Controllers\API\CareerController;
use App\Http\Controllers\API\CareerReplyController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\ResourceController;
use App\Http\Controllers\API\RSVPController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Middleware for authenticated users
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::put('/user/update-profile', [UserController::class, 'updateProfile']); // Update name & email
    Route::put('/user/update-password', [UserController::class, 'updatePassword']); // Change password

    // Admin-only routes
    Route::middleware('can:admin-only')->group(function () {
        Route::get('/users', [UserController::class, 'getAllUsers']); // Get all users
        Route::put('/user/{id}/change-role', [UserController::class, 'changeUserRole']); // Change role
        Route::delete('/user/{id}', [UserController::class, 'deleteUser']); // Delete user
    });
});




// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });



        // Career Routes
        Route::apiResource('careers', CareerController::class);
    
        // Career Reply Routes
        Route::apiResource('career-replies', CareerReplyController::class);
    
        // Event Routes
        Route::apiResource('events', EventController::class);
    
        // RSVP Routes
        Route::apiResource('rsvps', RSVPController::class);

    
        // Gallery Routes
        Route::apiResource('gallery', GalleryController::class);
    
        // Resource Routes
        Route::apiResource('resources', ResourceController::class);
    
        // Alumni Profile Routes
        Route::apiResource('alumni-profiles', AlumniProfileController::class);