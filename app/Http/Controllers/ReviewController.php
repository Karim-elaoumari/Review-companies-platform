<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review =  Review::with('user','company')->where('status',1)->latest()->get();
        return  new ReviewCollection($reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $review = Review::create([
            'content'=>$request->content,
            'stars'=>$request->stars,
            'status'=>1,
            'company_id'=>$request->company_id,
            'user_id'=>1,  
            // Auth::user()->id
        ]);
        return new ReviewResource($review);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        $review =  Review::with('company','user')->where('id',$review->id,'status',1)->get();
        return  new ReviewCollection($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->content = $request->content;
        $review->stars = $request->stars;
        $review->update();
        return new ReviewResource($review); 
    }

    // change status of review from active to hidden or visversa
    public function changeStatus(Review $review){
        if($review->status==0)$review->status=1; else $review->status=0;
        $review->update();
        return new ReviewResource($review); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review = Review::find($review->id)->where('user_id',1);
        $review->delete();
        return  response()->json(['success'=>'review deleted successufuly']);
    }
    
}
