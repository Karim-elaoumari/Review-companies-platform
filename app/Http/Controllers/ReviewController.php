<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews =  Review::with('company','comments','user')->where('status',1)
        ->latest()
        ->get();
        return  ReviewResource::collection($reviews);
    }
    public function getRelatedReviews()
    {  
        // get just the reviews where the manager id in the company table is equal to the user id
        $reviews =  Review::with('company','comments','user')->where('status',1)
        ->whereHas('company', function($q){
            $q->where('manager_id', JWTAuth::user()->id);
        })
        ->latest()
        ->get();
        return  ReviewResource::collection($reviews);
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
        // if the user hase reviewed a company 5 times in one day he can't review it again
        $reviews_user = Review::where('user_id', JWTAuth::user()->id)
        ->where('company_id', $request->company_id)
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->get();
        
        if(count($reviews_user) >= 2){
            return response()->json([
                'message' => "You can't review this company more than 2 times in one day"
            ], 403);
        }
        
        $review = Review::create([
            'content'=>$request->content,
            'stars'=>$request->stars,
            'status'=>1,
            'company_id'=>$request->company_id,
            'user_id'=>JWTAuth::user()->id,
           
        ]);
        $this->index();
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
