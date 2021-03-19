<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(ReviewCreateRequest $request){
        $review = new Review();
        $review->user_id = $request->get('user_id');
        $review->review_rating_id = $request->get('review_rating_id') ? $request->get('review_rating_id') : 1;
        $review->datetime = $request->get('datetime');
        $review->description = $request->get('description');

        if (!$review->save()) {
            return response()->json(['message'=>'Отзыв не отправлен']);
        }

        return response()->json(['message'=>$review->jsonSerialize()]);
    }
}
