<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Microfinance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $members = Member::with('microfinance')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $members,
            'message' => 'Members retrieved successfully'
        ]);
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'microfinance_id' => 'required|exists:microfinances,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'id_number' => 'required|string|max:20|unique:members,id_number',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
        ]);

        $member = Member::create($validated);

        return response()->json([
            'data' => $member->load('microfinance'),
            'message' => 'Member registered successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        $member->load('microfinance', 'loans');

        return response()->json([
            'data' => $member,
            'message' => 'Member retrieved successfully'
        ]);
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:100',
            'last_name' => 'sometimes|required|string|max:100',
            'phone' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|email|max:255',
            'address' => 'sometimes|required|string',
        ]);

        $member->update($validated);

        return response()->json([
            'data' => $member->load('microfinance'),
            'message' => 'Member updated successfully'
        ]);
    }

    /**
     * Activate the specified member.
     */
    public function activate(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);

        $member = Member::findOrFail($validated['member_id']);

        if ($member->status === 'Active') {
            return response()->json([
                'message' => 'Member is already active'
            ], Response::HTTP_BAD_REQUEST);
        }

        $member->update(['status' => 'Active']);

        return response()->json([
            'data' => $member->load('microfinance'),
            'message' => 'Member activated successfully'
        ]);
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json([
            'message' => 'Member deleted successfully'
        ], Response::HTTP_NO_CONTENT);
    }
}
