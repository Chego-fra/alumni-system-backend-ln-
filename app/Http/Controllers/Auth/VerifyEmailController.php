<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): JsonResponse|RedirectResponse
    {
        $user = $request->user();

        // If already verified, redirect or return JSON
        if ($user->hasVerifiedEmail()) {
            return $this->handleResponse($request, $user, true);
        }

        // Mark email as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->handleResponse($request, $user);
    }

    /**
     * Handle response based on request type (JSON or Redirect).
     */
    protected function handleResponse($request, $user, $alreadyVerified = false)
    {
        $redirectUrl = $this->redirectTo($user) . '?verified=1';

        // If the request expects JSON (e.g., API calls), return JSON
        if ($request->wantsJson()) {
            return response()->json([
                'message' => $alreadyVerified ? 'Email already verified' : 'Email verified successfully',
                'user' => $user->fresh(), // Ensure updated user data is sent
            ]);
        }

        // Otherwise, redirect to frontend dashboard
        return redirect()->intended($redirectUrl);
    }

    /**
     * Determine the redirect path based on the user's role.
     */
    protected function redirectTo($user): string
    {
        return match ($user->role) {
            'admin' => config('app.frontend_url') . '/dashboard/admin',
            'alumni' => config('app.frontend_url') . '/dashboard/alumni',
            'faculty' => config('app.frontend_url') . '/dashboard/faculty',
            default => config('app.frontend_url') . '/',
        };
    }
}
