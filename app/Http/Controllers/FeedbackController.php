<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $reviews = collect([
            (object) [
                'rating' => 5,
                'category' => 'Food',
                'is_pinned' => false,
                'title' => 'Great Pasta!',
                'created_at' => now(),
                'author' => 'Chef Tester',
                'content' => 'Loved the creamy sauce.',
                'response' => "Thank You!",
            ],
            // sample review kay waray pa db
        ]);

        return view('user/user-feedback-home', compact('reviews'));
    }
}
