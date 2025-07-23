<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $mockReviews = collect([
            (object) [
                'rating' => 5,
                'category' => 'Food',
                'is_pinned' => false,
                'title' => 'Great Pasta!',
                'created_at' => now(),
                'author' => 'Chef Tester',
                'feedback' => 'Loved the creamy sauce.',
                'response' => "Thank You!",
            ],
            (object) [
                'rating' => 2,
                'category' => 'Service',
                'is_pinned' => false,
                'title' => 'Slow service',
                'created_at' => now()->subDays(1),
                'author' => 'Jane',
                'feedback' => 'Waited 30 minutes.',
                'response' => null,
            ]
        ]);

        $userReviews = collect(session('reviews', []));
        $reviews = $userReviews->concat($mockReviews);

        // ✅ Filter by category if present
        if ($category = $request->input('category')) {
            $reviews = $reviews->where('category', $category);
        }

        $sort = $request->input('sort');

        if ($sort === 'high') {
            $reviews = $reviews->sortByDesc('rating');
        } elseif ($sort === 'low') {
            $reviews = $reviews->sortBy('rating');
        } else {
            $reviews = $reviews->sortByDesc('created_at');
        }



        return view('user/user-feedback-home', ['reviews' => $reviews]);
    }




    public function store(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'category' => 'required|string',
            'title' => 'nullable|string|max:255',
            'feedback' => 'nullable|string|max:500',
        ]);

        // Temporarily store in session since there's no DB
        $reviews = session('reviews', []);
        $data['is_pinned'] = false;
        $data['created_at'] = now();
        $data['author'] = null;
        $data['response'] = null;
        $reviews[] = (object) $data;
        session(['reviews' => $reviews]);

        return redirect()->route('feedback.home');
    }


}
