<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoanController extends Controller
{
    /**
     * Display a listing of the loans.
     */
    public function index()
    {
        $loans = Loan::with(['member.microfinance'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $loans,
            'message' => 'Loans retrieved successfully'
        ]);
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_type' => 'required|in:Emergency,Development,Business,Education',
            'amount' => 'required|numeric|min:1',
            'repayment_period' => 'required|integer|min:1',
        ]);

        $member = Member::findOrFail($validated['member_id']);

        // Check if member is active
        if ($member->status !== 'Active') {
            return response()->json([
                'message' => 'Member must be active to apply for a loan'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Check if member already has a pending loan
        if ($member->hasPendingLoan()) {
            return response()->json([
                'message' => 'Member already has a pending loan application'
            ], Response::HTTP_BAD_REQUEST);
        }

        $loan = Loan::create($validated);

        return response()->json([
            'data' => $loan->load('member.microfinance'),
            'message' => 'Loan application submitted successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified loan.
     */
    public function show(Loan $loan)
    {
        $loan->load('member.microfinance');

        return response()->json([
            'data' => $loan,
            'message' => 'Loan retrieved successfully'
        ]);
    }

    /**
     * Update the specified loan in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'loan_type' => 'sometimes|required|in:Emergency,Development,Business,Education',
            'amount' => 'sometimes|required|numeric|min:1',
            'repayment_period' => 'sometimes|required|integer|min:1',
            'status' => 'sometimes|required|in:Pending,Approved,Rejected',
        ]);

        $loan->update($validated);

        return response()->json([
            'data' => $loan->load('member.microfinance'),
            'message' => 'Loan updated successfully'
        ]);
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();

        return response()->json([
            'message' => 'Loan deleted successfully'
        ], Response::HTTP_NO_CONTENT);
    }
}
