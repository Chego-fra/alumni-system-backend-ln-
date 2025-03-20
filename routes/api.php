<?php

use App\Http\Controllers\API\AlumniProfileController;
use App\Http\Controllers\API\CareerController;
use App\Http\Controllers\API\CareerReplyController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\ResourceController;
use App\Http\Controllers\API\RSVPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;








Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

    // // Career Routes
    // Route::get('/careers', [CareerController::class, 'index']); // List careers with search & pagination
    // Route::post('/careers', [CareerController::class, 'store']); // Create a new career post
    // Route::get('/careers/{career}', [CareerController::class, 'show']); // Get single career details
    // Route::put('/careers/{career}', [CareerController::class, 'update']); // Update a career post
    // Route::delete('/careers/{career}', [CareerController::class, 'destroy']); // Delete a career post


    // Route::get('/career-replies', [CareerReplyController::class, 'index']); // List career replies
    // Route::post('/career-replies', [CareerReplyController::class, 'store']); // Add reply to career
    // Route::get('/career-replies/{reply}', [CareerReplyController::class, 'show']); // Get single reply
    // Route::put('/career-replies/{reply}', [CareerReplyController::class, 'update']); // Update reply
    // Route::delete('/career-replies/{reply}', [CareerReplyController::class, 'destroy']);


    // // Event Routes
    // Route::get('/events', [EventController::class, 'index']); // List events with search & pagination
    // Route::post('/events', [EventController::class, 'store']); // Create a new event
    // Route::get('/events/{event}', [EventController::class, 'show']); // Get event details
    // Route::put('/events/{event}', [EventController::class, 'update']); // Update event details
    // Route::delete('/events/{event}', [EventController::class, 'destroy']); // Delete an event


    // // RSVP Routes
    // Route::get('/rsvps', [RSVPController::class, 'index']); // List RSVPs
    // Route::post('/rsvps', [RSVPController::class, 'store']); // Create RSVP
    // Route::get('/rsvps/{rsvp}', [RSVPController::class, 'show']); // Get RSVP details
    // Route::put('/rsvps/{rsvp}', [RSVPController::class, 'update']); // Update RSVP
    // Route::delete('/rsvps/{rsvp}', [RSVPController::class, 'destroy']); // Delete RSVP


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