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
        $review->review_rating_id   = null;
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

    //public function showReviewById($id)
    //{
    //    return response()->json(Review::query()->find($id), 200);
    //}

    public function updateReview($id, Request $request)
    {
        $review                         = Review::query()->find($id);
        if ($review->user_id == Auth::id()) {
            $review->datetime           = date("d.m.Y", time());
            $review->description        = $request->input('description');

            if (!$review->save()) {
                return response()->json(['message'=>'Отзыв не изменён'], 404);
            }
            return response()->json(['message'=>$review->jsonSerialize()], 200);
        }
        return response()->json(['message' => 'Вы не можете изменить чужой отзыв'], 500);
    }

    public function deleteReview(Review $review)
    {
        if ($review->user_id == Auth::id()) {
            if ($review->delete()) {
                return response()->json(['message' => 'Отзыв удалён'], 200);
            } elseif (!$review) {
                return response()->json(['message' => 'Такого отзыва нет'], 404);
            }
            return response()->json(['message' => 'Отзыв не удалён'], 500);
        }
        return response()->json(['message' => 'Вы не можете удалить чужой отзыв'], 500);
    }

    public function updateEstimation($id, Request $request)
    {
        $review                     = Review::query()->find($id);
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

    //public function showReviewRatingById($id){
    //    return response()->json(ReviewRating::query()->find($id));
    //}

    public function storeEstimation($id, Request $request){
        $reviewRating = ReviewRating::query()->find($id);
        $reviewRating->estimation++;
    }
}
