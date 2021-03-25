<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ReviewCreateRequest $request){
        $review                     = new Review();
        $review->user_id            = Auth::id();
        $review->review_rating_id   = null;
        $review->datetime           = date("F j, Y");
        $review->description        = $request->get('description');

        if (!$review->save()) {
            return response()->json(['message'=>'Отзыв не отправлен']);
        }

        return response()->json(['message'=>$review->jsonSerialize()]);
    }

    public function show()
    {
        return response()->json(Review::all(), 200);
    }

    public function update($id, ReviewUpdateRequest $request){
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
}
