<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class ReviewController extends Controller
{
    public function store(Request $request, Film $film)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required|string',
        ]);
    
        Review::create([
            'film_id' => $request->film_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
    
        return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
    }

    public function edit(Review $review)
    {

    }

    public function update(Request $request, Review $review)
    {

    }

    public function destroy(Review $review)
    {
        
    }


}
