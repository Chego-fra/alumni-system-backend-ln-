<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectTo($user));
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }

    /**
     * Determine the redirect path based on the user's role.
     */
    protected function redirectTo($user): string
    {
        return match ($user->role) {
            'admin' => '/dashboard/admin',
            'alumni' => '/dashboard/alumni',
            'faculty' => '/dashboard/faculty',
            default => '/',
        };
    }
}
