<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use App\Models\ReviewRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JsonSerializable;

class ReviewController extends Controller
{
    public function store(ReviewCreateRequest $request){
        $review                     = new Review();
        $review->user_id            = Auth::id();
        $review->datetime           = date("d.m.Y", time());
        $review->description        = $request->get('description');
        if (!$review->save()) {
            return response()->json(['message'=>'Отзыв не отправлен'], 422);
        }

        return response()->json(['message'=> 'Отзыв отправлен'], 200);
    }

    public function showReview()
    {
        return response()->json(Review::all(), 200);
    }

    public function updateReview($id, Request $request)
    {
        $review                         = Review::query()->find($id);

        if (!$review) {
            return response()->json(['message' => 'Такого отзыва нет'], 404);
        }
        
        if ($review->user_id == Auth::id()) {
            $review->datetime           = date("d.m.Y", time());
            $review->description        = $request->input('description');

            if (!$review->save()) {
                return response()->json(['message'=>'Отзыв не изменён'], 422);
            }
            return response()->json(['message'=>'Отзыв изменён'], 200);
        }
        return response()->json(['message' => 'Вы не можете изменить чужой отзыв'], 403);
    }

    public function deleteReview(Review $review)
    {
        if (!$review) {
            return response()->json(['message' => 'Такого отзыва нет'], 404);
        }

        if ($review->user_id == Auth::id()) {
            if ($review->delete()) {
                return response()->json(['message' => 'Отзыв удалён'], 200);
            }
            return response()->json(['message' => 'Отзыв не удалён'], 422);
        }
        return response()->json(['message' => 'Вы не можете удалить чужой отзыв'], 403);
    }

    public function storeEstimation($reviewId) {
        $review = Review::query()->find($reviewId);

        if (!$review) {
            return response()->json(['message' => 'Такого отзыва нет'], 404);
        }

        $reviewRating               = new ReviewRating;
        $reviewRating->user_id      = Auth::id();
        $reviewRating->estimation   ++;
        $reviewRating->review_id    = $reviewId;

        $reviewRating->save();
        return response()->json(['message' => 'Отзыв оценён'], 200);
    }

    public function deleteEstimation(ReviewRating $reviewRating){
        if ($reviewRating->delete()) {
            return response()->json(['message' => 'Оценка отзыва удалена'], 200);
        }
        return response()->json(['message' => 'Оценка отзыва не удалена'], 422);
    }

    public function showReviewRating()
    {
        return response()->json(ReviewRating::all(), 200);
    }
}
