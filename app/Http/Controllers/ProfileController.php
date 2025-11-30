<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's notifications.
     */
    public function notification(Request $request): View
    {
        $user = $request->user();

        // Get notifications with pagination
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Statistics
        $totalNotifications = $user->notifications()->count();
        $unreadNotifications = $user->notifications()->unread()->count();
        $readNotifications = $user->notifications()->read()->count();
        $todayNotifications = $user->notifications()
            ->whereDate('created_at', today())
            ->count();

        return view('profile.notification', [
            'user' => $user,
            'notifications' => $notifications,
            'totalNotifications' => $totalNotifications,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'todayNotifications' => $todayNotifications,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Update member information for mahasiswa
        if ($request->user()->isMahasiswa() && $request->user()->member) {
            $memberData = $request->only(['phone', 'date_of_birth', 'gender', 'address']);
            $request->user()->member->update($memberData);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
