<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function reviews(){
        $reviews = Review::with('provider','user')->get();
        return view('dashboard.review.reviews',compact('reviews'));
    }
    public function deleteReview($rev_id){
        $review = Review::find($rev_id)->delete();
        return redirect()->back()->withErrors('Review deleted successfully');
    }
}
