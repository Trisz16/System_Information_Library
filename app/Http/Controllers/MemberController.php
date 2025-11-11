<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::withCount('loans')->paginate(10);
        return view('Manajemen.Anggota', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Manajemen.Anggota');
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
        return view('Manajemen.Anggota', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('Manajemen.Anggota', compact('member'));
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
}
