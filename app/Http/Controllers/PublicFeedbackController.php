<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class PublicFeedbackController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'business_owner_id' => 'required|exists:business_owners,id',
                'rating' => 'required|integer|min:1|max:5',
                'title' => 'nullable|string',
                'comment' => 'nullable|string',
                'category' => 'nullable|string',
                'is_flagged' => 'nullable|boolean',
                'is_public' => 'nullable|boolean',
                'user_name' => 'nullable|string',
            ]);

            $feedback = Feedback::create($validated);

            return response()->json(['message' => 'Feedback submitted successfully!', 'data' => $feedback], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

