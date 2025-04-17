<?php


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\API\V1\RSVPController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\CareerController;
use App\Http\Controllers\API\V1\EventsController;
use App\Http\Controllers\API\V1\GalleryController;
use App\Http\Controllers\API\V1\ResourcesController;
use App\Http\Controllers\API\V1\AlumniProfileController;
use App\Http\Controllers\API\V1\CareerRepliesController;





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' =>'auth:sanctum'], function () {
    Route::apiResource('alumniProfile', AlumniProfileController::class);

    Route::apiResource('career', CareerController::class);

    Route::apiResource('careerReplies', CareerRepliesController::class)->parameters([
        'careerReplies' => 'careerReplies'
    ]);

    Route::apiResource('events', EventsController::class)->parameters([
        'events' => 'events'
    ]);
    
    Route::apiResource('gallery', GalleryController::class);

    Route::apiResource('resources', ResourcesController::class)->parameters([
        'resources' => 'resources'
    ]);

    Route::apiResource('rSVP', RSVPController::class)->parameters([
        'rSVP' => 'rSVP'
    ]);

    Route::apiResource('users', UserController::class);

    Route::get('dashboardCount', [DashboardController::class, 'index']);

});


