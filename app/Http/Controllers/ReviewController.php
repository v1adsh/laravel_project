<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ReviewCreateRequest $request){
        $review                     = new Review();
        $review->user_id            = Auth::id();
        $review->review_rating_id   = 0;
        $review->datetime           = date("d.m.Y", time());
        $review->description        = $request->get('description');
        
        if (!$review->save()) {
            return response()->json(['message'=>'Отзыв не отправлен']);
        }

        return response()->json(['message'=>$review->jsonSerialize()]);
    }

    public function showReview()
    {
        return response()->json(Review::all(), 200);
    }

    public function showReviewById($id)
    {
        return response()->json(Review::query()->find($id), 200);
    }

    public function updateReview($id, ReviewUpdateRequest $request){
        $review                     = Review::query()->find($id);
        $review->user_id            = Auth::id();
        $review->review_rating_id   = null;
        $review->datetime           = $request->input('datetime');
        $review->description        = $request->input('description');

        if (!$review->save()) {
            return response()->json(['message'=>'Отзыв не отправлен']);
        }

        return response()->json(['message'=>$review->jsonSerialize()]);
    }

    public function updateEstimation($id, ReviewUpdateRequest $request){
        $review = Review::query()->find($id);
        $review->review_rating_id   = $request->input('estimation');

        if (!$review->save()) {
            return response()->json(['message'=>'Оценить отзыв не удалось']);
        }

        return response()->json(['message' => $review->jsonSerialize()]);
    }

    public function showReviewRating()
    {
        return response()->json(ReviewRating::all(), 200);
    }

    public function showReviewRatingById($id){
        return response()->json(ReviewRating::query()->find($id));
    }
}
