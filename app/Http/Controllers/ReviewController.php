<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function showReviewForm()
    {
        $foods = Food::all();
        return view('home.review_form', compact('foods'));
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:food,id',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'food_id' => $request->food_id,
            'review' => $request->review,
            'rating' => $request->rating,
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function allReviews()
    {
        $reviews = Review::with(['food', 'user'])->orderBy('date', 'desc')->get();
        return view('home.all_reviews', compact('reviews'));
    }
}
