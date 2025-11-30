<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberRegistrationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only apply to mahasiswa users
        if ($user && $user->role === 'mahasiswa') {
            // Load member relationship to ensure it's fresh from database
            $user->load('member');

            // Check if user has complete member profile
            if (!$user->member || !$user->member->isProfileComplete()) {
                // Allow access to member registration page and logout
                if ($request->routeIs('member.registration') || $request->routeIs('logout')) {
                    return $next($request);
                }
                return redirect()->route('member.registration')
                    ->with('error', 'Silakan lengkapi data anggota terlebih dahulu sebelum mengakses fitur ini.');
            }
        }

        return $next($request);
    }
}
