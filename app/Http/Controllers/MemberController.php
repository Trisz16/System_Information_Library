<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Member::withCount('loans');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $members = $query->paginate(10);
        return view('Manajemen.Anggota', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Manajemen.member_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female',
            'status' => 'required|in:active,inactive',
            'membership_date' => 'required|date|before_or_equal:today',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('Manajemen.member_show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('Manajemen.member_edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female',
            'status' => 'required|in:active,inactive',
            'membership_date' => 'required|date|before_or_equal:today',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        if ($member->loans()->where('status', 'active')->count() > 0) {
            return redirect()->route('members.index')->with('error', 'Cannot delete member with active loans.');
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    /**
     * Store member registration from student
     */
    public function storeMemberRegistration(\App\Http\Requests\StoreMemberRegistrationRequest $request)
    {
        $user = auth()->user();
        $existingMember = Member::where('user_id', $user->id)->first();

        $memberData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'status' => 'active',
        ];

        if ($existingMember) {
            $memberData['membership_date'] = $existingMember->membership_date ?? now();
            $existingMember->update($memberData);
            $member = $existingMember;
        } else {
            $memberData['user_id'] = $user->id;
            $memberData['membership_date'] = now();
            $member = Member::create($memberData);
        }

        // Notification for the user
        Notification::create([
            'user_id' => $user->id,
            'type' => 'member_registration',
            'title' => 'Pendaftaran Anggota Berhasil',
            'message' => 'Pendaftaran anggota Anda telah berhasil. Sekarang Anda dapat mengakses semua fitur.',
            'data' => ['member_id' => $member->id],
        ]);

        // Clear any cached member data and refresh user relationship
        $user->refresh();
        $user->load('member');

        // Notification for admin/staff
        $adminUsers = User::whereIn('role', ['admin', 'staff'])->get();
        foreach ($adminUsers as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'new_member',
                'title' => 'Anggota Baru Terdaftar',
                'message' => "Anggota baru '{$user->name}' telah mendaftar pada " . Carbon::now()->format('d/m/Y'),
                'data' => ['member_id' => $member->id],
            ]);
        }

        // Clear any cached member data and refresh user relationship
        $user->refresh();
        $user->load('member');

        // Redirect to dashboard after successful registration
        return redirect()->route('dashboard')->with('success', 'Pendaftaran anggota berhasil! Sekarang Anda dapat mengakses semua fitur peminjaman buku.');
    }

    /**
     * Show form for student to edit their own member profile
     */
    public function editProfile()
    {
        $user = auth()->user();
        $member = $user->member;

        if (!$member) {
            return redirect()->route('member.registration')->with('error', 'Silakan lengkapi data anggota terlebih dahulu.');
        }

        return view('Manajemen.member_profile_edit', compact('member'));
    }

    /**
     * Update student's own member profile
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $member = $user->member;

        if (!$member) {
            return redirect()->route('member.registration')->with('error', 'Data anggota tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'date_of_birth', 'gender']);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            $data['profile_photo_path'] = $photoPath;
        }

        $member->update($data);

        return redirect()->route('dashboard')->with('success', 'Profil anggota berhasil diperbarui.');
    }
}
