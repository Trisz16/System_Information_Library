<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ensure $user is an instance of our User model before calling hasRole
        if ($user instanceof User) {
            if ($user->hasRole('admin')) {
                return view('admin.dashboard');
            } elseif ($user->hasRole('staff')) {
                return view('staff.dashboard');
            } elseif ($user->hasRole('mahasiswa')) {
                return view('mahasiswa.dashboard');
            }
        }

        // Default fallback (guest or no matching role)
        return view('dashboard');
    }
}
