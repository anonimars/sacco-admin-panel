<?php

namespace App\Http\Controllers;

use App\Models\Microfinance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MicrofinanceController extends Controller
{
    /**
     * Display a listing of the microfinances.
     */
    public function index()
    {
        $microfinances = Microfinance::withCount(['members', 'activeMembers', 'pendingLoans'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $microfinances,
            'message' => 'Microfinances retrieved successfully'
        ]);
    }

    /**
     * Store a newly created microfinance in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:microfinances,email',
        ]);

        $microfinance = Microfinance::create($validated);

        return response()->json([
            'data' => $microfinance,
            'message' => 'Microfinance created successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified microfinance.
     */
    public function show(Microfinance $microfinance)
    {
        $microfinance->load(['members', 'activeMembers', 'pendingLoans']);

        return response()->json([
            'data' => $microfinance,
            'message' => 'Microfinance retrieved successfully'
        ]);
    }

    /**
     * Update the specified microfinance in storage.
     */
    public function update(Request $request, Microfinance $microfinance)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|email|unique:microfinances,email,' . $microfinance->id,
        ]);

        $microfinance->update($validated);

        return response()->json([
            'data' => $microfinance,
            'message' => 'Microfinance updated successfully'
        ]);
    }

    /**
     * Remove the specified microfinance from storage.
     */
    public function destroy(Microfinance $microfinance)
    {
        $microfinance->delete();

        return response()->json([
            'message' => 'Microfinance deleted successfully'
        ], Response::HTTP_NO_CONTENT);
    }
}
